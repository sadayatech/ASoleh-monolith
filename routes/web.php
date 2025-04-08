<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');
// Route::get('/dashboard/menu', function () {
//     return Inertia::render('MenuDashboard');
// })->name('menu');
// Route::get('/dashboard/settings', function () {
//     return Inertia::render('SettingsDashboard');
// })->name('settings');
// // middleware(
// // ['auth', 'verified']
// // )->

Route::get('/', [HomeController::class, 'renderHomePage'])->name('home');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::get('/checkout', [CartController::class, 'Checkout'])->name('confirm_checkout');
Route::post('/checkout', [OrderController::class, 'Checkout'])->name('checkout');
Route::get('/berhasil', fn () => Inertia::render('Berhasil'))->name('berhasil');
Route::get('/detail-transaksi/{order:transaction_code}', [OrderController::class, 'viewOrder'])->name('detailTransaksi');
Route::get('/pengaturan-akun', fn () => Inertia::render('PengaturanAkun'))->name('pengaturanAkun');
Route::get('/pusat-bantuan', fn () => Inertia::render('PusatBantuan'))->name('pusatBantuan');
Route::get('/transaksi', [OrderController::class, 'index'])->name('transaksi');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('keranjang.add');
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('auth/Login'))->name('login');
    Route::get('/daftar', fn () => Inertia::render('auth/Daftar'))->name('daftar');
});
Route::middleware('auth')->group(function () {
    Route::get('/akun', fn () => Inertia::render('Akun'))->name('akun');
    Route::get('/profil', fn () => Inertia::render('Profil'))->name('profil');
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
