<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');

Route::post('tambah_penyewa', 'PenyewaController@store')->middleware('jwt.verify');
Route::put('edit_penyewa/{id}', 'PenyewaController@update')->middleware('jwt.verify');
Route::delete('hapus_penyewa/{id}', 'PenyewaController@destroy')->middleware('jwt.verify');
Route::get('penyewa', 'PenyewaController@show')->middleware('jwt.verify');

Route::post('tambah_mobil', 'MobilController@store')->middleware('jwt.verify');
Route::put('edit_mobil/{id}', 'MobilController@update')->middleware('jwt.verify');
Route::delete('hapus_mobil/{id}', 'MobilController@destroy')->middleware('jwt.verify');
Route::get('mobil', 'MobilController@show')->middleware('jwt.verify');

Route::post('tambah_jenis', 'JenisController@store')->middleware('jwt.verify');
Route::put('edit_jenis/{id}', 'JenisController@update')->middleware('jwt.verify');
Route::delete('hapus_jenis/{id}', 'JenisController@destroy')->middleware('jwt.verify');
Route::get('jenis', 'JenisController@show')->middleware('jwt.verify');

Route::post('tambah_detail', 'DetailController@store')->middleware('jwt.verify');
Route::put('edit_detail/{id}', 'DetailController@update')->middleware('jwt.verify');
Route::delete('hapus_detail/{id}', 'DetailController@destroy')->middleware('jwt.verify');
Route::get('detail', 'DetailController@show')->middleware('jwt.verify');

Route::post('tambah_transaksi', 'TransaksiController@store')->middleware('jwt.verify');
Route::put('edit_transaksi/{id}', 'TransaksiController@update')->middleware('jwt.verify');
Route::delete('hapus_transaksi/{id}', 'TransaksiController@destroy')->middleware('jwt.verify');
Route::get('transaksi', 'TransaksiController@show')->middleware('jwt.verify');
