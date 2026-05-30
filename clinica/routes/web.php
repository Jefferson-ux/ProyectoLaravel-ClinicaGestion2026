<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('especialidades', EspecialidadesController::class);
    Route::resource('doctores', DoctoresController::class);
    Route::resource('pacientes', PacientesController::class);
    Route::resource('citas', CitasController::class);
    Route::post('citas/{id}/receta', [CitasController::class, 'storeReceta'])->name('citas.receta.store');
    Route::post('citas/{id}/pago', [CitasController::class, 'storePago'])->name('citas.pago.store');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
