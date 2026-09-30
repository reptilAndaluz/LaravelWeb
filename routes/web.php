<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);
=======
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('about', [MainController::class, 'about'])->name('about');
//Route::get('aboutRuta', [MainController::class, 'aboutMetodo'])->name('aboutNombre');
>>>>>>> master
