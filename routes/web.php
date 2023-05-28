<?php

use App\Http\Controllers\Supplier;
use App\Http\Controllers\Barang;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Yayasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [Supplier::class, 'index']);
Route::get('/tambahSupplier', [Supplier::class, 'tambahSupplier']);
Route::post('/save', [Supplier::class, 'save']);
Route::delete('/hapus/{id}', [Supplier::class, 'destroy']);
Route::put('/edit/{id}', [Supplier::class, 'edit']);
Route::get('/update/{id}', [Supplier::class, 'update']);

Route::get('/barang', [Barang::class, 'index']);
Route::post('/barang/save', [Barang::class, 'save']);
Route::delete('/barang/hapus/{id}', [Barang::class, 'destroy']);
Route::put('/barang/edit/{id}', [Barang::class, 'edit']);

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login/proses', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('admin', Admin::class);
    });
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::resource('yayasan', Yayasan::class);
    });
});
