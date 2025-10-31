<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// 🏠 HOME PAGE
Route::get('/', [ProductController::class, 'index'])->name('home');

// 🧾 AUTH ROUTES (Login / Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 🚪 LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 🏷️ PUBLIC CATEGORY & BRAND ROUTES
Route::resource('categories', CategoryController::class)->only(['index']);
Route::resource('brands', BrandController::class)->only(['index']);

// 🛍 PUBLIC PRODUCT ROUTES
Route::resource('products', ProductController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // 👤 PROFILE
    Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.show');

    // 🛒 CART
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('remove');
    });

    // ❤️ WISHLIST
    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/toggle/{product}', [WishlistController::class, 'toggle'])->name('toggle');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth + admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 📊 Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // 🧱 CRUD for Admin
    Route::resource('products', AdminProductController::class);
    Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('brands', BrandController::class)->except(['show']);
});
