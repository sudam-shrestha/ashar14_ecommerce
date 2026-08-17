<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
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

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/google/redirect', [AuthController::class, 'redirect'])->name('google.redirect');
Route::get('/google/callback', [AuthController::class, 'callback']);



// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');