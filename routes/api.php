<?php

use Illuminate\Http\Request;

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

Route::group([ 'middleware' => ['json.response'] ], function () {

    // Public routes

    Route::post('signup', 'Api\AuthController@signup');
    Route::post('login', 'Api\AuthController@login');

    // Private routes

    Route::group([ 'middleware' => 'auth:api' ], function() {

        Route::get('logout', 'Api\AuthController@logout');
        Route::get('account', 'Api\AuthController@account');

        Route::post('/post/create', 'PostController@store');
        Route::get('/post/edit/{id}', 'PostController@edit');
        Route::post('/post/update/{id}', 'PostController@update');
        Route::delete('/post/delete/{id}', 'PostController@destroy');
        Route::get('/posts', 'PostController@index');

    });

});
