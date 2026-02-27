<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VitrineController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\AvaliacaoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/vitrines', [VitrineController::class, 'index']);
Route::get('/vitrines/{slug}', [VitrineController::class, 'show']);
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/vitrines/{slug}/avaliacoes', [AvaliacaoController::class, 'store']);