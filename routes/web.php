<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\{
    CartController,
    AccountController,
    CheckoutController,
    FrontendController,
    Admin\AdminController,
    Admin\OrderController,
    Admin\ProductController,
    Admin\CategoryController,
    Admin\ContactInfoController,
    HomeController,
    ContactMessageController
};

// ✅ FIX: Remove the duplicate '/' route
Route::get('/', [FrontendController::class, 'welcome'])->name('home');

// Frontend Routes
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankYou'])->name('checkout.success');

// Product Routes
Route::get('/shop/{product:slug}', [ProductController::class, 'shopDetails'])->name('shop-details');

// Order Payment Status
Route::put('/admin/orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('admin.orders.update-payment-status');

// File download route
Route::get('/secure-receipts/{filename}', function ($filename) {
    $path = storage_path('app/public/receipts/' . $filename);
    if (!file_exists($path)) abort(404, 'File not found: ' . $path);
    return Response::file($path);
});

// Auth Routes
Auth::routes();

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AccountController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login', [AccountController::class, 'adminLogin'])->name('admin.login.post');

    Route::middleware(['auth', 'admin'])->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Products
        Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug']);

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/add', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/add', [FrontendController::class, 'store'])->name('categories.add');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Contact Messages
        Route::get('/contacts', [ContactMessageController::class, 'index'])->name('contact.index');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

        // Contact Info
        Route::resource('contact-info', ContactInfoController::class)->except(['create', 'store', 'destroy']);

        // Logout
        Route::post('/logout', [AccountController::class, 'adminLogout'])->name('logout');
    });
});

// Non-admin user home route
Route::get('/home', [HomeController::class, 'index'])->name('user.home');
