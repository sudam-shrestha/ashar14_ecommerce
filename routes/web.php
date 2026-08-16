<?php

use App\Http\Controllers\Frontend\DokanController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[PageController::class,'home'])->name('home');
Route::get("/products",[PageController::class,'products'])->name('products');
Route::get('/product/{slug}', [PageController::class, 'product_details'])->name('product.details');


Route::get("/terms-of-service",[PageController::class,'terms'])->name('terms');
Route::get("/privacy-policy",[PageController::class,'policy'])->name('policy');

Route::get("/dokan-registration",[DokanController::class,'index'])->name('dokan.index');
Route::post("/dokan-registration",[DokanController::class,'store'])->name('dokan.store');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
//     Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//     // Vendor Routes (only for vendors)
//     Route::middleware(['vendor'])->group(function () {
//         Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
//         Route::get('/vendor/products', [VendorController::class, 'products'])->name('vendor.products.index');
//     });
// });

// Route::get('/login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::get('/register', [Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');
