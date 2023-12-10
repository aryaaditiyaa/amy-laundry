<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Transaction';

        $transactions = Transaction::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                return $query->where('code', $request->keyword);
            })
            ->when($request->filled('start_date') && !$request->filled('end_date'), function ($query) use ($request) {
                return $query->whereDate('created_at', Carbon::parse($request->start_date)->startOfDay());
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                return $query->whereBetween('created_at', [Carbon::parse($request->start_date)->startOfDay(), Carbon::parse($request->end_date)->endOfDay()]);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->withWhereHas('items.product')
            ->withSum('items as total_price', 'price')
            ->paginate(8)
            ->withQueryString();

        return view('pages.transaction.index', compact('title', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Transaction';

        $carts = Cart::query()
            ->withWhereHas('product')
            ->get();

        $customers = User::query()
            ->select('id', 'name')
            ->customer()
            ->latest()
            ->get();

        return view('pages.transaction.create', compact('title', 'customers', 'carts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'payment_method' => ['required', 'in:debit,cash,other'],
            'payment_description' => ['nullable', 'string'],
        ]);

        try {
            DB::beginTransaction();

            $carts = Cart::query()
                ->withWhereHas('product')
                ->get();

            $transaction = Transaction::query()
                ->create(array_merge($validator->validated(), [
                    'code' => 'T-' . now()->format('dmYHis'),
                    'status' => $request->payment_method == 'cash' ? 'paid' : 'unpaid',
                ]));

            foreach ($carts as $cart) {
                TransactionItem::query()
                    ->create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $cart->product_id,
                        'qty' => $cart->qty,
                        'price' => $cart->product->price * $cart->qty,
                    ]);
            }

            Cart::query()->delete();

            DB::commit();
            return to_route('transaction.index')->with('success', 'Transaction created!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $title = 'Transaction Detail';

        $transaction->load(['user', 'items.product']);
        $transaction->loadSum('items as total_price', 'price');

        return view('pages.transaction.show', compact('title', 'transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function export(Request $request)
    {
        return Excel::download(
            new TransactionsExport(
                $request->keyword,
                $request->start_date,
                $request->end_date,
                $request->status,
            ), 'TRANSACTION REPORT.xlsx');
    }
}
