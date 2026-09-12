<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rotas de Authenticação da aplicação.
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // Rotas de usuário.
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::patch('/users/{user}/promote', [UserController::class, 'promote']);
    Route::patch('/users/{user}/lower', [UserController::class, 'lower']);
});
