<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $products_count = Product::query()->count();
        $customers_count = User::query()->customer()->count();
        $transactions_count = Transaction::query()->count();

        return view(
            'pages.dashboard.index',
            compact(
                'title',
                'products_count',
                'customers_count',
                'transactions_count',
            ));
    }
}
