<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Public Area */
Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('my-order', [HomeController::class, 'showTransactionPage'])->name('user.transaction.history');
    Route::get('login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('authenticate.login');
    Route::get('product-list', [HomeController::class, 'showPriceListPage'])->name('product-list');
});

Route::patch('/transaction/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');

/* Admin Area */
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('authenticate.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->except('show');
    Route::resource('customer', CustomerController::class)->except('show');
    Route::resource('product', ProductController::class)->except('show');
    Route::get('transaction/export', [TransactionController::class, 'export'])->name('transaction.export');
    Route::resource('transaction', TransactionController::class)->except(['edit', 'update']);
    Route::resource('cart', CartController::class)->except('show');
});

Route::get('mail', function (){
    $data = \App\Models\Transaction::query()
        ->with('items')
        ->withSum('items as total_price', 'price')
        ->find(6);

    return (new \App\Mail\TransactionCreatedMail($data))->render();
});
