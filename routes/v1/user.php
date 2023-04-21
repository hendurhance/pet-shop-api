<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('health-check', 'HealthCheckController@index')->name('health-check');

/*
|--------------------------------------------------------------------------
| User & Auth Namespace
|--------------------------------------------------------------------------
*/

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::group([
        'namespace' => 'User'
    ], function () {
        Route::get('/', 'UserController@show')->name('show');
        Route::delete('/', 'UserController@destroy')->name('destroy');

        Route::get('/orders', 'OrderController@index')->name('order.index');
        Route::put('/edit', 'UserController@edit')->name('edit');
    });

    Route::group([
        'namespace' => 'Auth'
    ], function () {
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('/create', 'RegisterController@store')->name('create');
        Route::get('/logout', 'LogoutController@logout')->name('logout');
        Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgot-password');
        Route::post('/reset-password-token', 'ResetPasswordController@resetPasswordToken')->name('reset-password-token');
    });
});

/*
| -------------------------------------------------------------------
|  MainPage API Routes
| -------------------------------------------------------------------
*/
Route::group([
    'namespace' => 'Main',
    'as' => 'main.',
    'prefix' => 'main',
], function () {
    Route::get('/promotions', 'PromotionController@index')->name('promotion.index');
    Route::apiResource('/blog', 'BlogController')->only(['index', 'show']);
});

/*
| -------------------------------------------------------------------
|  Categories API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Category',
], function () {
    Route::post('/category/create', 'CategoryController@store')->name('category.create');
    Route::apiResource('/category', 'CategoryController')->except(['store', 'index']);
    Route::get('/categories', 'CategoryController@index')->name('category.index');
});

/*
| -------------------------------------------------------------------
| Brands API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Brand',
], function () {
    Route::post('/brand/create', 'BrandController@store')->name('brand.create');
    Route::apiResource('/brand', 'BrandController')->except(['store', 'index']);
    Route::get('/brands', 'BrandController@index')->name('brand.index');
});

/*
| -------------------------------------------------------------------
|  Orders API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Order',
], function () {
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/shipment-locator', 'OrderController@shipmentLocator')->name('orders.shipment-locator');
    Route::get('/orders/dashboard', 'OrderController@dashboard')->name('orders.dashboard');
    Route::post('/order/create', 'OrderController@store')->name('orders.store');

    Route::apiResource('order', 'OrderController')->except(['store', 'index']);
    Route::get('/order/{uuid}/download', 'OrderController@download')->name('order.download');
});

/*
| -------------------------------------------------------------------
|  Order Statuses API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Order',
], function () {
    Route::post('/order-status/create', 'OrderStatusController@store')->name('order.status.store');
    Route::apiResource('/order-status', 'OrderStatusController')->except(['store', 'index']);
    Route::get('/order-statuses', 'OrderStatusController@index')->name('order.status.index');
});

/*
| -------------------------------------------------------------------
| Payment API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Payment',
], function () {
    Route::post('/payment/create', 'PaymentController@store')->name('payment.store');
    Route::apiResource('/payment', 'PaymentController')->except(['store', 'index']);
    Route::get('/payments', 'PaymentController@index')->name('payment.index');
});

/*
| -------------------------------------------------------------------
|  Product API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Product',
], function () {
    Route::post('/product/create', 'ProductController@store')->name('product.create');
    Route::apiResource('/product', 'ProductController')->except(['store', 'index']);
    Route::get('/products', 'ProductController@index')->name('product.index');
});

/*
| -------------------------------------------------------------------
|  File API Routes
| -------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'File',
    'as' => 'file.',
    'prefix' => 'file',
], function () {
    Route::post('/upload', 'FileController@upload')->name('upload');
    Route::get('{uuid}', 'FileController@show')->name('show');
});
