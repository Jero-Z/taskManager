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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@register');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('authenticate', 'AuthController@authenticate')->name('authenticate');//验证
Route::post('logout', 'AuthController@logout');//登出
//Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', "HomeController@index")->name('home');
    Route::post('token-refresh', 'AuthController@tokenRefresh');//刷新 token
});
