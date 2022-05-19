<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ExamenesController;
use App\Http\Controllers\Api\PreguntasController;
use App\Http\Controllers\Api\RespuestasController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\examenes_preguntasController;
use App\Http\Controllers\Api\ExamenesAllPreguntasController;
use App\Http\Controllers\Api\PreguntasAllRespuestasController;
use App\Http\Controllers\Api\RespuestasAllPreguntasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::get('/all-examenes', [ExamenesController::class, 'index'])->name(
        'all-examenes.index'
    );
    Route::post('/all-examenes', [ExamenesController::class, 'store'])->name(
        'all-examenes.store'
    );
    Route::get('/all-examenes/{examenes}', [
        ExamenesController::class,
        'show',
    ])->name('all-examenes.show');
    Route::put('/all-examenes/{examenes}', [
        ExamenesController::class,
        'update',
    ])->name('all-examenes.update');
    Route::delete('/all-examenes/{examenes}', [
        ExamenesController::class,
        'destroy',
    ])->name('all-examenes.destroy');

    // Examenes All Preguntas
    Route::get('/all-examenes/{examenes}/all-preguntas', [
        ExamenesAllPreguntasController::class,
        'index',
    ])->name('all-examenes.all-preguntas.index');
    Route::post('/all-examenes/{examenes}/all-preguntas', [
        ExamenesAllPreguntasController::class,
        'store',
    ])->name('all-examenes.all-preguntas.store');

    Route::get('/all-respuestas', [RespuestasController::class, 'index'])->name(
        'all-respuestas.index'
    );
    Route::post('/all-respuestas', [
        RespuestasController::class,
        'store',
    ])->name('all-respuestas.store');
    Route::get('/all-respuestas/{respuestas}', [
        RespuestasController::class,
        'show',
    ])->name('all-respuestas.show');
    Route::put('/all-respuestas/{respuestas}', [
        RespuestasController::class,
        'update',
    ])->name('all-respuestas.update');
    Route::delete('/all-respuestas/{respuestas}', [
        RespuestasController::class,
        'destroy',
    ])->name('all-respuestas.destroy');

    // Respuestas All Preguntas
    Route::get('/all-respuestas/{respuestas}/all-preguntas', [
        RespuestasAllPreguntasController::class,
        'index',
    ])->name('all-respuestas.all-preguntas.index');
    Route::post('/all-respuestas/{respuestas}/all-preguntas/{preguntas}', [
        RespuestasAllPreguntasController::class,
        'store',
    ])->name('all-respuestas.all-preguntas.store');
    Route::delete('/all-respuestas/{respuestas}/all-preguntas/{preguntas}', [
        RespuestasAllPreguntasController::class,
        'destroy',
    ])->name('all-respuestas.all-preguntas.destroy');
});
