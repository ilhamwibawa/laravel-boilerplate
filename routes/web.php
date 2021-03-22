<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::get('/profile', 'UserController@userProfile')->name('users.profile.index');
    Route::put('/profile', 'UserController@updateUserProfile')->name('users.profile.update');
    Route::put('/profile/password', 'UserController@updateUserPassword')->name('users.profile.password');
});
