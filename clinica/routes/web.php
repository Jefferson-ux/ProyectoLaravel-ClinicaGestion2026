<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('especialidades/{id}/restore', [EspecialidadesController::class, 'restore'])->name('especialidades.restore');
    Route::patch('pacientes/{id}/restore', [PacientesController::class, 'restore'])->name('pacientes.restore');
    Route::patch('doctores/{id}/restore', [DoctoresController::class, 'restore'])->name('doctores.restore');

    Route::get('citas/auditoria/recetas', [CitasController::class, 'recetas'])->name('citas.recetas');
    Route::get('citas/auditoria/recetas/{id}/editar', [CitasController::class, 'editReceta'])->name('citas.recetas.edit');
    Route::put('citas/auditoria/recetas/{id}', [CitasController::class, 'updateReceta'])->name('citas.recetas.update');
    Route::get('citas/auditoria/pagos', [CitasController::class, 'pagos'])->name('citas.pagos');
    Route::patch('citas/auditoria/pagos/{id}/anular', [CitasController::class, 'anularPago'])->name('citas.pagos.anular');

    Route::resource('especialidades', EspecialidadesController::class);
    Route::resource('doctores', DoctoresController::class);
    Route::resource('pacientes', PacientesController::class);
    Route::resource('citas', CitasController::class);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
