<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Transaction';
        $transactions = Transaction::query()
            ->withWhereHas('items.product')
            ->paginate(8);

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

            foreach ($carts as $cart){
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
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
}
