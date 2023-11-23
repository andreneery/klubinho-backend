<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClubIntegrantesController;
use App\Http\Controllers\EnquetesController;
use App\Http\Controllers\ReuniaoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// rota para alterar os dados do usuario
Route::post('/user/update/{id}', [AuthController::class, 'updateUserData']);
Route::get('/user/getUser/{id}', [AuthController::class, 'getUser']);

// users
Route::get('/user/getAllUsersNames/{id}', [AuthController::class, 'getAllNameByClub']); // essa será usada para a aba de reuniao de participantes

// rotas para cadastro do clube 
Route::post('/club/register', [ClubController::class, 'registerClub']);

//club
Route::get('/club/getClubByNickClub/{nick_club}', [ClubController::class, 'findClubByNickClub']);
Route::get('/club/getClubById/{id}', [ClubController::class, 'getClub']);

// rotas para o post
Route::post('/post/create', [PostController::class, 'createPost']);
Route::post('/post/delete/{id}', [PostController::class, 'deletePost']);
Route::get('/post/getAllPostByUser/{id}', [PostController::class, 'getAllPostByUser']);
Route::get('/post/getAllPostByClub/{id}', [PostController::class, 'getAllPostByClub']);

// clubIntegrantes
Route::post('/clubIntegrantes/create', [ClubIntegrantesController::class, 'create']);
Route::get('/clubIntegrantes/getClubIntegrantes/{club_id}', [ClubIntegrantesController::class, 'getAllIntegrantesByClub']);
Route::get('/clubIntegrantes/getClubIntegrantesWithUser/{club_id}', [ClubIntegrantesController::class, 'getAllIntegrantesWithUserByClub']);
Route::get('/clubIntegrantes/getTotalIntegrantes/{club_id}', [ClubIntegrantesController::class, 'getNumberOfIntegrantesByClub']);

// enquete
Route::post('/enquete/create', [EnquetesController::class, 'create']);
Route::get('/enquete/getAllEnquetesByClub/{club_id}', [EnquetesController::class, 'getAllEnquetesByClub']);
Route::post('/enquete/alterStatusEnquete/{id}', [EnquetesController::class, 'alterStatusEnquete']);

// rotas para a reuniao
Route::post('/reuniao/create', [ReuniaoController::class, 'createReuniao']);
Route::get('/reuniao/getAllReuniaoByClub/{club_id}', [ReuniaoController::class, 'getAllReuniaoByClub']);
Route::post('/reuniao/createComment', [ReuniaoController::class, 'createComment']);
Route::get('/reuniao/getReuniao/{id}', [ReuniaoController::class, 'getReuniao']);
Route::get('/reuniao/getAllCommentsByReuniao/{reuniao_id}', [ReuniaoController::class, 'getAllCommentsByReuniao']);


// rota para upload de foto 
Route::post('/upload/{id}', [AuthController::class, 'uploadImagem']);

// rota para pegar a imagem do usuario
Route::get('/user/getImage/{id}', [AuthController::class, 'getImagem']);

// rota para upload de banner_imagem no club
Route::post('/uploadBanner/{id}', [ClubController::class, 'uploadImagem']);

// rota para pegar a imagem do club
Route::get('/club/getImage/{id}', [ClubController::class, 'getImagem']);

// rota para editar user
Route::post('/user/edit/{id}', [AuthController::class, 'editUser']);

//edit reuniao
Route::post('/reuniao/edit/{id}', [ReuniaoController::class, 'editReuniao']);