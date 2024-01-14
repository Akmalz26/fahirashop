<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('register.index');
Route::post('/register', 'App\Http\Controllers\RegisterController@store')->name('register.store');

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@check_login')->name('login.check_login');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
Route::get('/logout', 'App\Http\Controllers\DashboardController@logout')->name('dashboard.logout');

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::middleware(['auth'])->group(function () {

Route::resource('/produk', App\Http\Controllers\ProdukController::class);
Route::resource('/pelanggan', App\Http\Controllers\PelangganController::class);
Route::resource('/kasir', App\Http\Controllers\KasirController::class);
Route::resource('/transaksi', App\Http\Controllers\TransaksiController::class);
Route::resource('/penjualan', App\Http\Controllers\PenjualanController::class);


});