<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Profile\ProfileController;

Route::get('/profile', [ProfileController::class, 'index']);
Route::put('/profile', [ProfileController::class, 'update']); // para salvar perfil
