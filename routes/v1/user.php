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
        Route::get('/', 'UserController@show')->name('user.show');
        Route::delete('/', 'UserController@destroy')->name('user.destroy');

        Route::get('/orders', 'OrderController@index')->name('order.index');
        Route::put('/edit', 'UserController@edit')->name('edit');
    });

    Route::group([
        'namespace' => 'Auth'
    ], function () {
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('/create', 'RegisterController@create')->name('register');
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
    Route::resource('/blog', 'BlogController')->only(['index', 'show']);
});

// /*
// | -------------------------------------------------------------------
// |  Categories API Routes
// | -------------------------------------------------------------------
// */

// Route::group([
//     'namespace' => 'Category',
// ], function () {
//     Route::post('/category', 'CategoryController@create')->name('category.create');
//     Route::resource('/category', 'CategoryController')->except(['create', 'index']);
//     Route::get('/categories', 'CategoryController@index')->name('category.index');
// });

// /*
// | -------------------------------------------------------------------
// | Brands API Routes
// | -------------------------------------------------------------------
// */

Route::group([
    'namespace' => 'Brand',
], function () {
    Route::post('/brand', 'BrandController@create')->name('brand.create');
    Route::resource('/brand', 'BrandController')->except(['create', 'index']);
    Route::get('/brands', 'BrandController@index')->name('brand.index');
});

// /*
// | -------------------------------------------------------------------
// |  Orders API Routes
// | -------------------------------------------------------------------
// */

// Route::group([
//     'namespace' => 'Order',
// ], function () {
//     Route::get('/orders', 'OrderController@index')->name('orders.index');
//     Route::get('/orders/shipment-locator', 'OrderController@shipmentLocator')->name('orders.shipment-locator');
//     Route::get('/orders/dashboard', 'OrderController@dashboard')->name('orders.dashboard');
//     Route::post('/orders', 'OrderController@create')->name('orders.create');

//     Route::resource('order', 'OrderController')->except(['create', 'index']);
//     Route::get('/order/{uuid}/download', 'OrderController@products')->name('order.download');
// });


// /*
// | -------------------------------------------------------------------
// |  Order Statuses API Routes
// | -------------------------------------------------------------------
// */

// Route::group([
//     'namespace' => 'Order/Status',
// ], function () {
//     Route::post('/order-status/create', 'OrderStatusController@create')->name('order.status.create');
//     Route::resource('/order-status', 'OrderStatusController')->except(['create', 'index']);
//     Route::get('/order-statuses', 'OrderStatusController@index')->name('order.status.index');
// });

// /*
// | -------------------------------------------------------------------
// | Payment API Routes
// | -------------------------------------------------------------------
// */

// Route::group([
//     'namespace' => 'Payment',
// ], function () {
//     Route::post('/payment', 'PaymentController@create')->name('payment.create');
//     Route::resource('/payment', 'PaymentController')->except(['create', 'index']);
//     Route::get('/payments', 'PaymentController@index')->name('payment.index');
// });

// /*
// | -------------------------------------------------------------------
// |  Product API Routes
// | -------------------------------------------------------------------
// */

// Route::group([
//     'namespace' => 'Product',
// ], function () {
//     Route::post('/product', 'ProductController@create')->name('product.create');
//     Route::resource('/product', 'ProductController')->except(['create', 'index']);
//     Route::get('/products', 'ProductController@index')->name('product.index');
// });

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