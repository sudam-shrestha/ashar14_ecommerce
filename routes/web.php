<?php

use App\Http\Controllers\Frontend\DokanController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[PageController::class,'home'])->name('home');
Route::get("/terms-of-service",[PageController::class,'terms'])->name('terms');
Route::get("/privacy-policy",[PageController::class,'policy'])->name('policy');

Route::get("/dokan-registration",[DokanController::class,'index'])->name('dokan.index');
Route::post("/dokan-registration",[DokanController::class,'store'])->name('dokan.store');

