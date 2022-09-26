<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');


Route::group(['middleware' => ['auth']], function () {

    Route::get('reservas/listado', [App\Http\Controllers\ReservasController::class, 'listado'])->name('reservas.listado');
    Route::get('reserva/nueva', [App\Http\Controllers\ReservasController::class, 'nueva'])->name('reserva.nueva');
    // Route::post('reservar/nueva', [App\Http\Controllers\ReservasController::class, 'nueva'])->name('reservar.nueva');
    Route::post('reservar/guardar', [App\Http\Controllers\ReservasController::class, 'guardar'])->name('reservar.guardar');
    Route::get('reservar/ver/{id}', [App\Http\Controllers\ReservasController::class, 'ver'])->name('reservar.ver');
    Route::post('reservar/aprobador/{id}', [App\Http\Controllers\ReservasController::class, 'aprobador'])->name('reservar.aprobador');
    Route::get('reservar/verbuscador/{id}', [App\Http\Controllers\ReservasController::class, 'verbuscador'])->name('reservar.verbuscador');

    Route::post('insumos/select', [App\Http\Controllers\InsumosController::class, 'select'])->name('insumos.select');

    Route::post('sector/select', [App\Http\Controllers\SectorController::class, 'select'])->name('sector.select');
    
    Route::post('horarios/horario', [App\Http\Controllers\HorariosController::class, 'horario'])->name('horarios.horario');

    Route::get('calendario/index', [App\Http\Controllers\CalendarioController::class, 'index'])->name('calendario.index');

});