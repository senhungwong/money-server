<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Version 1 */
Route::group(['prefix' => 'v1'], function () {
    /* Auth */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');

        /* Authorization Required */
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'AuthController@logout');
        });
    });

    /* User */
    Route::group(['prefix' => 'users'], function () {
        Route::post('/', 'UserController@create');

        /* Authorization Required */
        Route::group(['middleware' => 'auth:api'], function () {
            Route::delete('/', 'UserController@destroy');
        });
    });

    /* Wallet */
    Route::group(['prefix' => 'wallets', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'WalletController@index');
        Route::post('/', 'WalletController@create');
    });

    /* Store */
    Route::group(['prefix' => 'stores', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'StoreController@index');
        Route::post('/', 'StoreController@create');
    });

    /* Service */
    Route::group(['prefix' => 'services', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'ServiceController@index');
        Route::post('/', 'ServiceController@create');
    });

    /* Transaction */
    Route::group(['prefix' => 'transactions', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'TransactionController@index');
        Route::post('/', 'TransactionController@create');
    });

    /* Log */
    Route::group(['prefix' => 'logs', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'LogController@index');
    });
});
