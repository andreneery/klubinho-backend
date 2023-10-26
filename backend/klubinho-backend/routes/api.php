<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// rotas para cadastro do clube 
Route::post('/club/register', [ClubController::class, 'registerClub'])->middleware('auth:sanctum');

// rotas para o post
Route::post('/post/create', [PostController::class, 'createPost'])->middleware('auth:sanctum');
Route::post('/post/delete/{id}', [PostController::class, 'deletePost'])->middleware('auth:sanctum');

