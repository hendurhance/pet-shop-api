<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('health-check', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Admin API is running',
    ]);
})->name('health-check');

/*
|--------------------------------------------------------------------------
| Auth Namespace
|--------------------------------------------------------------------------
|
*/

Route::group([
    'namespace' => 'Auth',
    'as' => 'auth.',
], function () {
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/create', 'AuthController@create')->name('create');
});

/*
|--------------------------------------------------------------------------
| User Namespace
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'User',
    'as' => 'user.',
], function () {
    Route::get('/user-listing', 'UserController@listing')->name('listing');
    Route::put('/user-edit/{uuid}', 'UserController@edit')->name('edit');
    Route::delete('/user-delete/{uuid}', 'UserController@delete')->name('delete');
});