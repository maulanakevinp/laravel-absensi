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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AuthController@index')->name('auth.index')->middleware('guest');
Route::post('/login', 'AuthController@login')->name('login')->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web', 'auth', 'roles']], function(){
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::resource('/kehadiran', 'PresentsController');
    Route::get('/kehadiran/cari', 'PresentController@search')->name('kehadiran.cari');
    Route::get('/ganti-password', 'UsersController@gantiPassword')->name('ganti-password');
    Route::patch('/update-password/{user}', 'UsersController@updatePassword')->name('update-password');
    Route::get('/profil', 'UsersController@profil')->name('profil');
    Route::patch('/update-profil/{user}', 'UsersController@updateProfil')->name('update-profil');

    Route::group(['roles' => 'Admin'], function(){
        Route::get('/users/cari', 'UsersController@search')->name('users.search');
        Route::patch('/users/password/{user}', 'UsersController@password')->name('users.password');
        Route::resource('/users', 'UsersController');
    });

    Route::group(['roles' => 'Pegawai'], function(){

    });
});
