<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Auth::routes();

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/add', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/add', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/shoppingcart', [ShoppingCartController::class, 'store'])->name('shoppingcart.store');
Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shoppingcart.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shoppingcart.index');
    Route::put('/shoppingcart/{id}', [ShoppingCartController::class, 'update'])->name('shoppingcart.update');
    Route::delete('/shoppingcart/{id}', [ShoppingCartController::class, 'destroy'])->name('shoppingcart.destroy');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart');

// These routes are already set up by Breeze, so you don't need custom controllers for them
Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('/register', function() {
    return view('auth.register');   
})->name('register');