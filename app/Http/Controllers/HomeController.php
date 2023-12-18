<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';

        $products = Product::query()
            ->latest('name')
            ->take(6)
            ->get();

        return view('pages.index', compact('title', 'products'));
    }

    public function showTransactionPage(Request $request)
    {
        $title = 'Track Order';

        if ($request->filled('keyword')) {
            $transactions = Transaction::query()
                ->with('history')
                ->when($request->filled('keyword'), function (Builder $query) use ($request) {
                    $query->where('code', $request->keyword);
                    $query->orWhere(function ($query) use ($request) {
                        $query->whereRelation('user', 'phone_number', '=', $request->keyword);
                        $query->orWhereRelation('user', 'email', '=', $request->keyword);
                    });
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
                ->latest()
                ->paginate(8)
                ->withQueryString();
        } else {
            $transactions = [];
        }

        return view('pages.my-order', compact('title', 'transactions'));
    }

    /*public function showTransactionInfoPage()
    {
        $title = '';
        return view('pages.order-info', compact('title'));
    }*/

    public function showPriceListPage()
    {
        return 'price';
    }
}
