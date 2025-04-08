<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'renderHomePage'])->name('home');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::get('/checkout', [CartController::class, 'Checkout'])->name('confirm_checkout');
Route::post('/checkout', [OrderController::class, 'Checkout'])->name('checkout');
Route::get('/berhasil', fn () => Inertia::render('Berhasil'))->name('berhasil');
Route::get('/detail-transaksi/{order:transaction_code}', [OrderController::class, 'viewOrder'])->name('detailTransaksi');

Route::get('/pusat-bantuan', fn () => Inertia::render('PusatBantuan'))->name('pusatBantuan');
Route::get('/transaksi', [OrderController::class, 'index'])->name('transaksi');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('keranjang.add');
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('auth/Login'))->name('login');
    Route::get('/daftar', fn () => Inertia::render('auth/Daftar'))->name('daftar');
});
Route::get('/akun', fn () => Inertia::render('Akun'))->name('akun');
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pengaturan-akun', fn () => Inertia::render('PengaturanAkun'))->name('pengaturan-akun');
});

require __DIR__.'/auth.php';
