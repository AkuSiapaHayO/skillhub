<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('peserta', PesertaController::class);
Route::resource('kelas', KelasController::class);
Route::resource('pendaftaran', PendaftaranController::class)->only([
    'index', 'create', 'store', 'destroy'
]);
