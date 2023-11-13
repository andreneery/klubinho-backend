<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClubIntegrantesController;
use App\Http\Controllers\EnquetesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// rota para alterar os dados do usuario
Route::post('/user/update/{id}', [AuthController::class, 'updateUserData'])->middleware('auth:sanctum');
Route::get('/user/getUser/{id}', [AuthController::class, 'getUser'])->middleware('auth:sanctum');

// users
Route::get('/user/getAllUsersNames/{id}', [AuthController::class, 'getAllNameByClub']); // essa será usada para a aba de reuniao de participantes

//upload de foto de perfil usuario
Route::post('/user/uploadProfilePicture/{id}', [AuthController::class, 'updateProfilePicture']);

// rotas para cadastro do clube 
Route::post('/club/register', [ClubController::class, 'registerClub'])

// rotas para o post
Route::post('/post/create', [PostController::class, 'createPost']);
Route::post('/post/delete/{id}', [PostController::class, 'deletePost']);
Route::get('/post/getAllPostByUser/{id}', [PostController::class, 'getAllPostByUser']);
Route::get('/post/getAllPostByClub/{id}', [PostController::class, 'getAllPostByClub']);

// clubIntegrantes
Route::post('/clubIntegrantes/create', [ClubIntegrantesController::class, 'create']);
Route::get('/clubIntegrantes/getClubIntegrantes/{club_id}', [ClubIntegrantesController::class, 'getAllIntegrantesByClub']);
Route::get('/clubIntegrantes/getClubIntegrantesWithUser/{club_id}', [ClubIntegrantesController::class, 'getAllIntegrantesWithUserByClub']);

// enquete
Route::post('/enquete/create', [EnquetesController::class, 'create']);
Route::get('/enquete/getAllEnquetesByClub/{club_id}', [EnquetesController::class, 'getAllEnquetesByClub']);
Route::post('/enquete/alterStatusEnquete/{id}', [EnquetesController::class, 'alterStatusEnquete']);

// rotas para a reuniao
Route::post('/reuniao/create', [ReuniaoController::class, 'createReuniao']);
Route::get('/reuniao/getAllReuniaoByClub/{club_id}', [ReuniaoController::class, 'getAllReuniaoByClub']);
Route::post('/reuniao/createComment', [ReuniaoController::class, 'createComment']);
Route::get('/reuniao/getAllCommentsByClub/{club_id}', [ReuniaoController::class, 'getAllCommentsByClub']);