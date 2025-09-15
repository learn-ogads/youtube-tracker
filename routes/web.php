<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoriesController::class, 'index'])->name('home');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

//Route::get('/', [VideosController::class, 'index'])->name('home');
Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');
Route::delete('/videos/{id}', [VideosController::class, 'destroy'])->name('videos.destroy');

