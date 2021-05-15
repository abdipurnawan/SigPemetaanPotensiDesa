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

    //Agama
    Route::get('/agama/home', 'AgamaController@index')->name('agama.home');
    Route::post('/agama/store', 'AgamaController@store')->name('agama.store');
    Route::get('/agama/edit/{id}', 'AgamaController@edit')->name('agama.edit');
    Route::post('/agama/update/{id}', 'AgamaController@update')->name('agama.update');
    Route::post('/agama/delete', 'AgamaController@delete')->name('agama.delete');
});

