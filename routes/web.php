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

    Route::get('/ganti-password', 'UsersController@gantiPassword')->name('ganti-password');
    Route::patch('/update-password/{user}', 'UsersController@updatePassword')->name('update-password');
    Route::get('/profil', 'UsersController@profil')->name('profil');
    Route::patch('/update-profil/{user}', 'UsersController@updateProfil')->name('update-profil');

    Route::group(['roles' => 'Admin'], function(){
        Route::get('/users/cari', 'UsersController@search')->name('users.search');
        Route::patch('/users/password/{user}', 'UsersController@password')->name('users.password');
        Route::resource('/users', 'UsersController');

        Route::get('/kehadiran', 'PresentsController@index')->name('kehadiran.index');
        Route::get('/kehadiran/cari', 'PresentsController@search')->name('kehadiran.search');
        Route::get('/kehadiran/{user}/cari', 'PresentsController@cari')->name('kehadiran.cari');
        Route::get('/kehadiran/excel-users', 'PresentsController@excelUsers')->name('kehadiran.excel-users');
        Route::get('/kehadiran/{user}/excel-user', 'PresentsController@excelUser')->name('kehadiran.excel-user');
        Route::post('/kehadiran/ubah', 'PresentsController@ubah')->name('ajax.get.kehadiran');
        Route::patch('/kehadiran/{kehadiran}', 'PresentsController@update')->name('kehadiran.update');
        Route::post('/kehadiran', 'PresentsController@store')->name('kehadiran.store');
    });

    Route::group(['roles' => 'Pegawai'], function(){
        Route::get('/daftar-hadir', 'PresentsController@show')->name('daftar-hadir');
        Route::get('/daftar-hadir/cari', 'PresentsController@cariDaftarHadir')->name('daftar-hadir.cari');
    });

    // ATUR IP ADDRESS DISINI
    Route::group(['middleware' => ['ipcheck:'.config('absensi.ip_address')]], function() {
        Route::patch('/absen/{kehadiran}', 'PresentsController@checkOut')->name('kehadiran.check-out');
        Route::post('/absen', 'PresentsController@checkIn')->name('kehadiran.check-in');
    });
});
