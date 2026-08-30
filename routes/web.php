<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Menu
Route::get('/menu', [MenuController::class, 'index'])
    ->name('menu');

Route::get('/menu/{product}', [MenuController::class, 'show'])
    ->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('/cart', [CartController::class, 'clear'])
    ->name('cart.clear');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('products', ProductController::class);

        Route::resource('categories', CategoryController::class);

    });


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })
        ->middleware('verified')
        ->name('dashboard');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
|
| Customer dapat checkout tanpa wajib login.
|
*/

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])
    ->name('checkout.success');


/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
|
| My Orders dapat diakses tanpa wajib login.
|
*/

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('orders', AdminOrderController::class)
        ->only(['index', 'show', 'update']);

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';  