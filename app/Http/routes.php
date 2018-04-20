<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
// Route::get('register', 'Auth\AuthController@showRegistrationForm');
// Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

// User Routes
Route::get('assets', 'HomeController@index');
Route::get('asset/{asset}', 'HomeController@show');
Route::get('download/{file}', 'HomeController@download');
Route::get('settings', 'HomeController@settings');
Route::patch('settings', 'HomeController@settingsUpdate');

// Admin Group & Routes
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('assets', 'AssetController@index');
    Route::resource('asset', 'AssetController');

    Route::get('asset-file/{file}', 'AssetFileController@show');
    Route::delete('asset-file/{file}', 'AssetFileController@destroy');

    Route::get('users', 'UserController@index');
    Route::resource('user', 'UserController');
});
