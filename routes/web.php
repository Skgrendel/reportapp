<?php

use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\FuntionController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\ReportesverificacionController;
use App\Models\reportesverificacion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/funtion/busqueda/{id}', [FuntionController::class, 'BuscarContrato'])->name('Contrato');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware('check_user_status')->group(function () {
        Route::resource('/reportes', ReportesController::class)->names('reportes');
        Route::resource('/coordinador', CoordinadorController::class)->names('coordinador');
        Route::resource('/personals', PersonalsController::class)->names('personals');
        Route::get('/admin', adminController::class)->name('admin');
        Route::post('/addcomercio', [ReportesController::class, 'addcomercio'])->name('addcomercio');
        Route::get('/busqueda', [DireccionesController::class, 'index'])->name('busqueda');
        Route::get('/informes', [InformesController::class, 'InfoGeneral'])->name('informes');
        Route::get('/test', [InformesController::class, 'testEndpoint'])->name('testEndpoint');
        Route::resource('/auditorias', AuditoriaController::class)->names('auditorias');
        Route::get('/confirmadas', [FuntionController::class,'anomaliasok'])->name('confirmadas');
        Route::resource('/verificacion',ReportesverificacionController::class)->names('verificacion');
        Route::get('reportall',[FuntionController::class,'exportReports'])->name('ExportarReportes');
        Route::get('reportrevisados',[FuntionController::class,'exportReportsRevisados'])->name('ExportarRevisados');
    });
});
