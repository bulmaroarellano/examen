<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ExamenesController;
use App\Http\Controllers\RespuestasController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    // ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-examenes', [ExamenesController::class, 'index'])->name(
            'all-examenes.index'
        );
        Route::post('all-examenes', [ExamenesController::class, 'store'])->name(
            'all-examenes.store'
        );
        Route::get('all-examenes/create', [
            ExamenesController::class,
            'create',
        ])->name('all-examenes.create');
        Route::get('all-examenes/{examenes}', [
            ExamenesController::class,
            'show',
        ])->name('all-examenes.show');
        Route::get('all-examenes/{examenes}/edit', [
            ExamenesController::class,
            'edit',
        ])->name('all-examenes.edit');
        Route::put('all-examenes/{examenes}', [
            ExamenesController::class,
            'update',
        ])->name('all-examenes.update');
        Route::delete('all-examenes/{examenes}', [
            ExamenesController::class,
            'destroy',
        ])->name('all-examenes.destroy');

        Route::get('all-respuestas', [
            RespuestasController::class,
            'index',
        ])->name('all-respuestas.index');
        Route::post('all-respuestas', [
            RespuestasController::class,
            'store',
        ])->name('all-respuestas.store');
        Route::get('all-respuestas/create', [
            RespuestasController::class,
            'create',
        ])->name('all-respuestas.create');
        Route::get('all-respuestas/{respuestas}', [
            RespuestasController::class,
            'show',
        ])->name('all-respuestas.show');
        Route::get('all-respuestas/{respuestas}/edit', [
            RespuestasController::class,
            'edit',
        ])->name('all-respuestas.edit');
        Route::put('all-respuestas/{respuestas}', [
            RespuestasController::class,
            'update',
        ])->name('all-respuestas.update');
        Route::delete('all-respuestas/{respuestas}', [
            RespuestasController::class,
            'destroy',
        ])->name('all-respuestas.destroy');
    });
