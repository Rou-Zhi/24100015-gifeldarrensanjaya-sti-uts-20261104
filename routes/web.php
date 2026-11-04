<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('matakuliah', MatakuliahController::class)
    ->except(['show']);

Route::resource('absensi', AbsensiController::class)
    ->only(['index', 'create', 'store']);

Route::resource('mahasiswa', MahasiswaController::class)
    ->except(['show']);