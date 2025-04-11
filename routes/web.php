<?php

use App\Http\Controllers\Auth\{
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    LoginController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    RegisterController,
    VerifyEmailController
};
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'renderHomePage'])->name('home');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('keranjang.add');
Route::get('/checkout', [CartController::class, 'Checkout'])->name('confirm_checkout');
Route::post('/checkout', [OrderController::class, 'Checkout'])->name('checkout');
Route::get('/berhasil', fn() => Inertia::render('Berhasil'))->name('berhasil');
Route::get('/detail-transaksi/{order:transaction_code}', [OrderController::class, 'viewOrder'])->name('detailTransaksi');
Route::get('/pusat-bantuan', fn() => Inertia::render('PusatBantuan'))->name('pusatBantuan');
Route::post('/upload-bukti/{order}', [OrderController::class, 'uploadBukti']);
Route::get('/transaksi', [OrderController::class, 'index'])->name('transaksi');
Route::get('/underconstruction', fn() => Inertia::render('UnderConstruction'));

/*
|--------------------------------------------------------------------------
| Guest Only Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => Inertia::render('auth/Login'))->name('login');
    Route::get('/daftar', fn() => Inertia::render('auth/Daftar'))->name('daftar');

    // Auth Controllers
    // Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    // Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    // Forgot password
    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset password
    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    // Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/akun', fn() => Inertia::render('Akun'))->name('akun');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pengaturan-akun', fn() => Inertia::render('PengaturanAkun'))->name('pengaturan-akun');
    Route::get('/admin/dashboard', [DashboardController::class, 'render_home'])->name('dashboard');
    Route::get('/admin/menu', [DashboardController::class, 'render_menu'])->name('dashboard.menu');
    Route::get('/admin/supplier', [DashboardController::class, 'render_supplier'])->name('dashboard.supplier');
    Route::get('/admin/users', [DashboardController::class, 'render_users'])->name('dashboard.users');

    // Kasir
    Route::get('/kasir/dashboard', fn() => Inertia::render('kasir/HomeDashboard'));
    Route::get('/kasir/pesanan', fn() => Inertia::render('kasir/Pesanan'));
    Route::get('/kasir/riwayat', fn() => Inertia::render('kasir/Riwayat'));
    Route::get('/kasir/pengaturan', fn() => Inertia::render('kasir/Pengaturan'));
    Route::get('/kasir/berhasil', fn() => Inertia::render('kasir/Berhasil'));

    // Pelayan
    Route::get('/pelayan/dashboard', fn() => Inertia::render('pelayan/HomeDashboard'));
    Route::get('/pelayan/supplier', fn() => Inertia::render('pelayan/Supplier'));
    Route::get('/pelayan/pengaturan', fn() => Inertia::render('pelayan/Pengaturan'));


    // Email Verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Password Confirmation and Update
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password/update', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    
    // Item
    Route::post('item/toggle/{item}', [ItemController::class, 'toggleActiveState'])->name('toggle.item');
    Route::put('item/update/{item}', [ItemController::class, 'update'])->name('update.item');
    Route::post('item/store', [ItemController::class, 'store'])->name('store.item');
    Route::delete('item/delete/{item}', [ItemController::class, 'destroy'])->name('delete.item');
});
