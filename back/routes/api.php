<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// CONTROLADOR DONDE ESTÁN ALOJADAS TODAS LAS RUTAS Y MÉTODOS PARA ESTE PROYECTO
Route::controller(MessagesController::class)->group(function () {
    Route::get('/v1/inbox', 'getAll');
    Route::post('/v1/messages', 'create');
    Route::delete('/v1/messages/{id}', 'delete');
    Route::put('/v1/messages/{id}', 'update');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
