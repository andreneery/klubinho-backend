<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClubController;

Route::post('/user', [UserController::class, 'create']);

Route::get('/user/{email}', [UserController::class, 'showUserByEmail']);

// Create a new route for the club controller

Route::post('/club', [ClubController::class, 'create']);

Route::get('/club/{club_name}', [ClubController::class, 'showClubByClubName']);

Route::put('/club/{id}', [ClubController::class, 'updateById']);

Route::put('/club/{club_name}', [ClubController::class, 'updateByClubName']);

Route::delete('/club/{id}', [ClubController::class, 'deleteById']);
