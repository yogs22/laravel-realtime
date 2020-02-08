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

Route::get('/', function () {
    return view('welcome');
});

Route::get('feedback/create', 'FeedbackController@create')->name('feedback');
Route::get('feedback/dashboard', 'FeedbackController@dashboard');

Route::get('qr-code', 'QrCodeController@index');

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('feedback/data', 'FeedbackController@dashboardData');
    Route::post('feedback', 'FeedbackController@store');
});
