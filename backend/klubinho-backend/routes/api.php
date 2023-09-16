<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user', [UserController::class, 'create']);
// Route::get('/user', [UserController::class, 'read']);