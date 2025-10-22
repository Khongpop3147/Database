<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ProductAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/gate-test', function () {
    return \Illuminate\Support\Facades\Gate::allows('admin') ? 'admin ok' : 'not admin';
});

// หน้าแรก
Route::get('/', [HomeController::class, 'index'])->name('home');

// สินค้า (สาธารณะ)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->whereNumber('product')
    ->name('products.show');

// ต้องล็อกอินก่อน
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // โปรไฟล์
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ตะกร้า
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->whereNumber('product')->name('cart.add');
    Route::post('/cart/update/{item}', [CartController::class, 'update'])->whereNumber('item')->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->whereNumber('item')->name('cart.remove');

    // ชำระเงิน
    Route::get('/checkout', [CheckoutController::class, 'summary'])->name('checkout.summary');
    Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

    // รีวิวสินค้า
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
        ->whereNumber('product')
        ->name('reviews.store');
});

// กลุ่มแอดมิน (เฉพาะผู้มีสิทธิ์)
Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.products.index'))->name('home');
        Route::resource('products', ProductAdminController::class)->except(['show']);
    });

require __DIR__ . '/auth.php';
