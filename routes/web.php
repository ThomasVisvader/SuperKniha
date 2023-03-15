<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomepageController::class, 'index'])->name('index');

Route::get('/products/create', [ProductController::class, 'create'])->middleware(['auth', 'can:create,App\Models\Product'])->name('newProduct');

Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth', 'can:edit,App\Models\Product'])->name('editProduct');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/user/{id}', [UserController::class, 'show'])->name('profile');

Route::put('/user/{id}', [UserController::class, 'update'])->name('update_profile');

Route::put('/products/edit/{id}', [ProductController::class, 'update'])->middleware(['auth', 'can:edit,App\Models\Product'])->name('updateProduct');

Route::put('/products/{id}', [CartController::class, 'update'])->name('add_to_cart');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/cart/edit/{id}', [CartController::class, 'changeCart'])->name('changeCart');

Route::post('/cart/delete/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

Route::get('/cart/delivery-payment', [CartController::class, 'getDeliveryPayment'])->name('deliveryAndPayment');

Route::post('/cart/delivery-payment', [CartController::class, 'setDeliveryPayment'])->name('setDeliveryPayment');

Route::get('/cart/personal-info', [CartController::class, 'getPersonalInfo'])->name('personalInfo');

Route::post('/cart/personal-info', [CartController::class, 'setPersonalInfo'])->name('setPersonalInfo');

Route::get('/cart/checkout', [CartController::class, 'getCheckout'])->name('checkout');

Route::post('/cart/checkout', [CartController::class, 'placeOrder'])->name('placeOrder');

Route::post('/products', [ProductController::class, 'store'])->middleware(['auth', 'can:create,App\Models\Product'])->name('createProduct');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware(['auth', 'can:delete,App\Models\Product'])->name('deleteProduct');

require __DIR__.'/auth.php';
