<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\OrderController as FrontOrderController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index']);
Route::get('/products',[HomeController::class,'products'])->name('products');
// البحث عن المنتجات
Route::get('/search', [HomeController::class, 'search'])->name('search');
// صفحة تفاصيل المنتج
Route::get('/product{id}',[HomeController::class, 'show'])->name('product.show');
// مسارات السلة
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

// مسارات الطلبات
Route::get('/checkout', [App\Http\Controllers\Front\OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/store', [App\Http\Controllers\Front\OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{id}', [App\Http\Controllers\Front\OrderController::class, 'success'])->name('order.success');

// صفحة الـ dashboard - تحويل للأدمن
Route::get('/dashboard', function () {
    return redirect('/admin/categories');
})->middleware(['auth', 'verified'])->name('dashboard');

// مسارات الـ Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات لوحة التحكم (الأدمن)
Route::prefix('admin')->middleware(['auth' , 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
});

// مسارات المصادقة (Login, Register...)
require __DIR__.'/auth.php';