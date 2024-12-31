<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/menu', function() {
    return view('menu');
});

Route::get('/produk', function() {
    return view('produk');
});

Route::get('/cart', function() {
    return view('cart');
});

Route::get('/checkout', function() {
    return view('checkout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
