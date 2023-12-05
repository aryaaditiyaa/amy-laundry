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
Route::get('/', [HomeController::class, 'index'])->name('home');

/* Admin Area */
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('authenticate.login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('authenticate.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->except('show');
    Route::resource('customer', CustomerController::class)->except('show');
    Route::resource('product', ProductController::class)->except('show');
    Route::resource('transaction', TransactionController::class)->except('show');
    Route::resource('cart', CartController::class)->except('show');
});

