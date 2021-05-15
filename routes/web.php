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

Route::get('/test', function () {
    return view('layouts.admin');
});

//ADMIN ROUTE
Route::group(['prefix' => 'admin'], function () {
    //HOME
    Route::get('/dashboard', 'AdminController\DashboardController@dashboard')->name('Dashboard');

    //Auth Route
    Route::get('/login', 'AdminController\AuthController@loginForm')->name('Login Form')->middleware('guest');
    Route::post('/login', 'AdminController\AuthController@login')->name('Login');
    Route::get('/logout', 'AdminController\AuthController@logout')->name('Logout');

    //Desa
    Route::get('/desa', 'AdminController\DesaController@index')->name('admin-desa-home');
    Route::get('/desa/create', 'AdminController\DesaController@create')->name('admin-desa-create');
    Route::post('/desa/store', 'AdminController\DesaController@store')->name('admin-desa-store');
    Route::get('/desa/{id}/edit', 'AdminController\DesaController@edit')->name('admin-desa-edit');
    Route::post('/desa/{id}/store', 'AdminController\DesaController@update')->name('admin-desa-update');
    Route::get('/desa/{id}/delete', 'AdminController\DesaController@destroy')->name('admin-desa-delete');
    Route::get('/desa/{id}/show', 'AdminController\DesaController@show')->name('admin-desa-show');

    //Sekolah
    Route::get('/sekolah', 'AdminController\SekolahController@index')->name('admin-sekolah-home');
    Route::get('/sekolah/create', 'AdminController\SekolahController@create')->name('admin-sekolah-create');
    Route::post('/sekolah/store', 'AdminController\SekolahController@store')->name('admin-sekolah-store');
    Route::get('/sekolah/{id}/edit', 'AdminController\SekolahController@edit')->name('admin-sekolah-edit');
    Route::post('/sekolah/{id}/store', 'AdminController\SekolahController@update')->name('admin-sekolah-update');
    Route::get('/sekolah/{id}/delete', 'AdminController\SekolahController@destroy')->name('admin-sekolah-delete');
    Route::get('/sekolah/{id}/show', 'AdminController\SekolahController@show')->name('admin-sekolah-show');
});

