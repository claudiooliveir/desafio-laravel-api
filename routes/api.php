<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Listar todos + filtros (GET /api/users?name=&cpf=&from=&to=)
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Criar usuário (POST /api/users)
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Detalhar usuário (GET /api/users/1)
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Atualizar usuário (PUT /api/users/1)
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Deletar usuário (DELETE /api/users/1)
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route::apiResource('/users', UserController::class);
//com essa linha, o Laravel já cria as rotas para as operações de CRUD (Create, Read, Update, Delete) para o recurso "users", utilizando os métodos correspondentes no UserController.


