<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('about', [MainController::class, 'about'])->name('about');
Route::get('array', [MainController::class, 'array'])->name('array');
Route::get('a/r/r/a/y', [MainController::class, 'array'])->name('array');
// Route::get('aboutRuta', [MainController::class, 'aboutMetodo'])->name('aboutNombre');
Route::get('portfolio', [MainController::class, 'portfolio'])->name('portfolio');
Route::get('gestion', [MainController::class, 'gestion'])->name('gestion');

// las 7 rutas
/*Route::get('alumno/create', [AlumnoController::class, 'create'])->name('alumno.create');
Route::post('alumno', [AlumnoController::class, 'store'])->name('alumno.store');
Route::get('alumno/{alumno}/edit', [AlumnoController::class, 'edit'])->name('alumno.edit');
Route::get('alumno', [AlumnoController::class, 'index'])->name('alumno.index');
Route::put('alumno/{alumno}', [AlumnoController::class, 'update'])->name('alumno.update');
Route::get('alumno/{alumno}', [AlumnoController::class, 'show'])->name('alumno.show');
Route::delete('alumno/{alumno}', [AlumnoController::class, 'destroy'])->name('alumno.destroy');*/
Route::resource('alumno', AlumnoController::class);
Route::resource('modulo', ModuloController::class);
Route::get('alumno/{alumno}/matricular', [AlumnoController::class, 'matricular'])->name('alumno.matricular');
Route::get('modulo/{modulo}/matricular', [ModuloController::class, 'matricular'])->name('modulo.matricular');
Route::post('matricula/{alumno}/make', [MatriculaController::class, 'make'])->name('matricula.make');
Route::post('matricula/storemodules', [MatriculaController::class, 'storeModules'])->name('matricula.storemodules');
Route::post('matricula/storealumnos', [MatriculaController::class, 'storeAlumnos'])->name('matricula.storealumnos');
Route::post('modulo/storealumnos', [MatriculaController::class, 'storeAlumnos'])->name('modulo.storealumnos');
Route::post('modulo/{modulo}/matricular', [MatriculaController::class, 'storeAlumnos'])->name('modulo.matricular.post');
Route::resource('profesor', ProfesorController::class);
Route::resource('matricula', MatriculaController::class);
