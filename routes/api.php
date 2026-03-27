<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VitrineController;
use App\Http\Controllers\Api\VitrineManageController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\AvaliacaoController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\GaleriaFotoController;
use App\Http\Controllers\Api\HorarioController;

// ── Rotas públicas ──────────────────────────────────────
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/vitrines', [VitrineController::class, 'index']);
Route::get('/vitrines/{slug}', [VitrineController::class, 'show']);
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/vitrines/{slug}/avaliacoes', [AvaliacaoController::class, 'store']);

// ── Rotas autenticadas (empreendedor) ───────────────────
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Minha Vitrine
    Route::get('/minha-vitrine', [VitrineManageController::class, 'show']);
    Route::post('/minha-vitrine', [VitrineManageController::class, 'store']);
    Route::post('/minha-vitrine/update', [VitrineManageController::class, 'update']);

    // Serviços
    Route::get('/minha-vitrine/servicos', [ServicoController::class, 'index']);
    Route::post('/minha-vitrine/servicos', [ServicoController::class, 'store']);
    Route::put('/minha-vitrine/servicos/{id}', [ServicoController::class, 'update']);
    Route::delete('/minha-vitrine/servicos/{id}', [ServicoController::class, 'destroy']);

    // Galeria
    Route::get('/minha-vitrine/galeria', [GaleriaFotoController::class, 'index']);
    Route::post('/minha-vitrine/galeria', [GaleriaFotoController::class, 'store']);
    Route::put('/minha-vitrine/galeria/{id}', [GaleriaFotoController::class, 'update']);
    Route::delete('/minha-vitrine/galeria/{id}', [GaleriaFotoController::class, 'destroy']);

    // Horários
    Route::get('/minha-vitrine/horarios', [HorarioController::class, 'index']);
    Route::post('/minha-vitrine/horarios', [HorarioController::class, 'upsert']);

    // Avaliações (gerenciar)
    Route::get('/minha-vitrine/avaliacoes', [VitrineManageController::class, 'avaliacoes']);
    Route::patch('/minha-vitrine/avaliacoes/{id}/aprovar', [VitrineManageController::class, 'aprovarAvaliacao']);
    Route::delete('/minha-vitrine/avaliacoes/{id}', [VitrineManageController::class, 'rejeitarAvaliacao']);
});