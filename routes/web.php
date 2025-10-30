<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to
| the "web" middleware group.
|
*/

// 🏠 HOME PAGE
Route::get('/', [ProductController::class, 'index'])->name('home');

// 🧾 AUTH ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 🔐 AUTHENTICATED USER ROUTES
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

// 🏷️ CATEGORY & BRAND — public index, admin restricted for create/delete
Route::resource('categories', CategoryController::class)->only(['index']);
Route::resource('brands', BrandController::class)->only(['index']);

// 🛍 PRODUCTS
Route::resource('products', ProductController::class)->only(['index', 'show']);


// 🧭 ADMIN ROUTES (optional for admin panel)
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('brands', BrandController::class)->except(['show']);
});
