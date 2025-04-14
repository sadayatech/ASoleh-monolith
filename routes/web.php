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
use App\Http\Controllers\SupplierController;
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
Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('keranjang.update');
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('keranjang.destroy');
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
    Route::get('/admin/dashboard', [DashboardController::class, 'render_home'])->middleware('role:admin')->name('dashboard');
    Route::get('/admin/menu', [DashboardController::class, 'render_menu'])->middleware('role:admin')->name('dashboard.menu');
    Route::get('/admin/supplier', [DashboardController::class, 'render_supplier'])->middleware('role:admin')->name('dashboard.supplier');
    Route::get('/admin/users', [DashboardController::class, 'render_users'])->middleware('role:admin')->name('dashboard.users');

    // Kasir
    Route::get('/kasir/dashboard', [DashboardController::class, 'render_cashier_dashboard'])->name('kasir.dashboard')->middleware('role:kasir,admin');
    Route::get('/kasir/pesanan', [DashboardController::class, 'render_cashier_orders'])->name('kasir.pesanan')->middleware('role:kasir,admin');
    Route::get('/kasir/riwayat', [DashboardController::class, 'render_cashier_history'])->name('kasir.riwayat')->middleware('role:kasir,admin');
    Route::get('/kasir/pengaturan', fn() => Inertia::render('kasir/Pengaturan'))->middleware('role:kasir,admin');
    Route::get('/kasir/berhasil', fn() => Inertia::render('kasir/Berhasil'))->middleware('role:kasir,admin');
    Route::post('/kasir/cart/add', [CartController::class, 'cashier_add_to_cart'])->name('kasir.keranjang.add')->middleware('role:kasir,admin');
    Route::patch('/pesanan/{order}', [OrderController::class, 'updateOrderStatus'])->name('kasir.update_order_status')->middleware('role:kasir,admin');


    // Pelayan
    Route::get('/pelayan/dashboard', [DashboardController::class, 'render_menu'])->middleware('role:staff,admin');
    Route::get('/pelayan/supplier', [DashboardController::class, 'render_supplier'])->middleware('role:staff,admin');
    Route::get('/pelayan/pengaturan', fn() => Inertia::render('pelayan/Pengaturan'))->middleware('role:staff,admin');


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
    Route::post('item/toggle/{item}', [ItemController::class, 'toggleActiveState'])->name('toggle.item')->middleware('role:admin,staff');
    Route::put('item/update/{item}', [ItemController::class, 'update'])->name('update.item')->middleware('role:admin,staff');
    Route::post('item/store', [ItemController::class, 'store'])->name('store.item')->middleware('role:admin,staff');
    Route::delete('item/delete/{item}', [ItemController::class, 'destroy'])->name('delete.item')->middleware('role:admin,staff');
    // Supplier
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('store.supplier')->middleware('role:admin,staff');
    Route::put('supplier/update/{supplier}', [SupplierController::class, 'update'])->name('update.supplier')->middleware('role:admin,staff');
    Route::delete('supplier/delete/{supplier}', [SupplierController::class, 'destroy'])->name('delete.supplier')->middleware('role:admin,staff');
});
