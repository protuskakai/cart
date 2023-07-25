<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
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


Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::POST('search', [ProductController::class, 'productSearch'])->name('product.search');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('thanks', [CheckoutController::class, 'thanks'])->name('cart.thanks');
Route::get('/api/payment', [CheckoutController::class, 'stkpush'])->name('payment');
Route::get('update', [ProductController::class, 'update'])->name('update');
Route::get('tinypesa', [CheckoutController::class, 'tinypesa'])->name('tinypesa');
Route::get('aboutus', [ProductController::class, 'aboutus'])->name('aboutus');
Route::get('home', [ProductController::class, 'home'])->name('home');
Route::get('contacts', [ProductController::class, 'contacts'])->name('contacts');
Route::get('tinypesa2', [CheckoutController::class, 'tinypesa2'])->name('tinypesa2');
Route::get('/api/callback', [CheckoutController::class, 'callback'])->name('callback');
Route::get('registerurl', [CheckoutController::class, 'registerurl'])->name('registerurl');
Route::get('/api/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
Route::get('/api/confirmation2', [CheckoutController::class, 'confirmation2'])->name('confirmation2');
Route::get('/api/confirmation3', [CheckoutController::class, 'confirmation3'])->name('confirmation3');
Route::get('/api/validation', [CheckoutController::class, 'validation'])->name('validation');
//Route::Post('/api/callbackurl', [checkoutController::class,'mpesaresponse'])->name('mpesaresponse');
Route::get('/api/tinypesa_calback', [CheckoutController::class, 'tinypesa_calback'])->name('tinypesa_calback');
Route::get('/api/tinypesa_stkpush', [CheckoutController::class, 'tinypesa_stkpush'])->name('tinypesa_stkpush');