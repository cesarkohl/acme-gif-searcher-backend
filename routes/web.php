<?php

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

Route::get('r/{code}', 'Api\ShorturlController@redirect');

Route::get('/{any}', function () {
    return view('any');
})->where('any', '.*');
