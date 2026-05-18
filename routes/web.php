<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você registra as rotas da sua aplicação. 
| A rota de login personalizada deve vir antes de qualquer outra para 
| evitar que pacotes como o Filament ou o Breeze a sobrescrevam.
|
*/

// 1. ROTA DE LOGIN PERSONALIZADA (Prioridade Máxima)
Route::get('/login', function () {
    return view('login-select');
})->name('login');

// 2. REDIRECIONAMENTO DA RAIZ
Route::get('/', function () {
    return redirect('/login');
});

// 3. ROTA DO DASHBOARD (Protegida por Autenticação)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 4. GRUPO DE ROTAS DE PERFIL (Usuário Autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* | Nota: O 'require __DIR__.'/auth.php';' foi removido para evitar 
| conflitos com a sua tela de login customizada. Se você precisar 
| de rotas de recuperação de senha futuramente, precisará 
| registrá-las manualmente ou restaurar o arquivo com cautela.
*/
