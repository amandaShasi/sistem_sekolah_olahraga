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
    return view('layouts.master');
});

Route::resource('/cabor', \App\Http\Controllers\CaborController::class);
Route::resource('/prestasi', \App\Http\Controllers\PrestasiController::class);
Route::resource('/siswa', \App\Http\Controllers\SiswaController::class);
Route::resource('/pelanggaran', \App\Http\Controllers\PelanggaranController::class);
Route::resource('/berita', \App\Http\Controllers\BeritaController::class);
Route::resource('/pelatih', \App\Http\Controllers\PelatihController::class);