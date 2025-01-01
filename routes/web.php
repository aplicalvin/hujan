<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/signup', function() {
    return view('signup');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/produk', [ProductController::class, 'index'])->name('product');
Route::post('/produk', [ProductController::class, 'addToCart'])->name('product.add.to.cart');
Route::post('/produk/remove', [ProductController::class, 'removeFromCart'])->name('product.remove.from.cart');
Route::get('/produk/cart', [ProductController::class, 'getCart'])->name('product.cart');
Route::get('/cart', function() {return view('cart');})->name('cart');

Route::post('/transaction/checkout', [TransactionController::class, 'store'])->name('checkout');
Route::get('/checkout', function() {
    return view('checkout');
})->name('payment.receipt');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
