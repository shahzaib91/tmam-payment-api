<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function() {

    Route::group(['prefix' => 'webhook'], function() {
        Route::put('subscribe', 'WebhookController@subscribe');
        Route::put('state', 'WebhookController@state');
    });

    Route::group(['prefix' => 'transaction'], function() {
        Route::get('list/{merchantId}', 'TransactionController@index');
        Route::post('create', 'TransactionController@store');
    });

});
