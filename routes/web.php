<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {session()->forget('cart'); return view('landing');})->name('landing');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/menu', [MenuController::class, 'addToCart'])->name('menu.add.to.cart');
Route::post('/menu/remove', [MenuController::class, 'removeFromCart'])->name('menu.remove.from.cart');
Route::get('/menu/cart', [MenuController::class, 'getCart'])->name('menu.cart');

Route::get('/produk', [ProductController::class, 'index'])->name('product');
Route::post('/produk', [ProductController::class, 'addToCart'])->name('product.add.to.cart');
Route::post('/produk/remove', [ProductController::class, 'removeFromCart'])->name('product.remove.from.cart');
Route::get('/produk/cart', [ProductController::class, 'getCart'])->name('product.cart');
Route::get('/cart', function() {return view('cart');})->name('cart');

Route::post('/transaction/checkout', [TransactionController::class, 'store'])->name('checkout');
Route::get('/transaction/6/{invoice_number}', [TransactionController::class, 'show'])->name('transaction.status');
Route::get('/checkout', function() {return view('checkout');})->name('payment.receipt');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
});

require __DIR__.'/auth.php';
