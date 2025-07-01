<?php
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\File;

// use App\Http\Controllers\ContactMessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
// Frontend Routes
Route::get('/', [FrontendController::class, 'welcome'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
// Route::get('/shop/{id}', [FrontendController::class, 'shopDetails'])->name('shop-details');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
// Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankYou'])->name('checkout.success');
// Product routes
Route::get('/shop/{product:slug}', [ProductController::class, 'shopDetails'])->name('shop-details');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');


// In web.php
Route::put('/admin/orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('admin.orders.update-payment-status');

// Authentication Routes
Auth::routes();
Route::get('/secure-receipts/{filename}', function ($filename) {
    $path = storage_path('app/public/receipts/' . $filename); // or 'app/receipts/' if that's your actual location

    if (!file_exists($path)) {
        abort(404, 'File not found: ' . $path);
    }

    return Response::file($path);
});
// Admin Routes - Combined into a single group
Route::prefix('admin')->group(function() {
    // Login Routes (public)
    Route::get('/login', [AccountController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login', [AccountController::class, 'adminLogin'])->name('admin.login.post');

    // Protected Admin Routes (require auth and admin middleware)
    Route::middleware(['auth', 'admin']) ->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
       // Product Routes
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');  
        Route::get('/products/add', [ProductController::class, 'create'])->name('products.create');        
        Route::post('/products/add', [ProductController::class, 'store'])->name('products.add');  
        Route::get('/products/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product:slug}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy');

        
        // Category Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');  
        Route::get('/categories/add', [CategoryController::class, 'create'])->name('categories.create');        
        Route::post('/categories/add', [FrontendController::class, 'store'])->name('categories.add');  
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
      
        //Contacts rOUTE
         Route::get('/contacts', [ContactMessageController::class, 'index'])->name('contact.index');  
         
        // Order Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');





        // Contact Info Routes
        Route::resource('contact-info', ContactInfoController::class)
            ->except(['create', 'store', 'destroy']);
        
        Route::post('/logout', [AccountController::class, 'adminLogout'])->name('logout');
    });
});

// Remove this duplicate line as it's already called above
// Auth::routes();

// You can keep this if you need a separate home route for non-admin users
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/debug-log', function () {
    $logPath = storage_path('logs/laravel.log');

    if (!File::exists($logPath)) {
        return 'No log file found.';
    }

    return nl2br(e(File::get($logPath)));
});