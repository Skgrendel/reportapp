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
| Aquí puedes registrar las rutas web para tu aplicación. Estas rutas son
| cargadas por el RouteServiceProvider dentro de un grupo que contiene el
| middleware "web". Crea algo grandioso!
|
*/

// Ruta para la página principal de la aplicación, redirige al formulario de login.
Route::get('/', function () {
    return view('auth.login');
});

// Ruta para buscar un contrato basado en su ID.
Route::get('/funtion/busqueda/{id}', [FuntionController::class, 'BuscarContrato'])->name('Contrato');

// Grupo de rutas que requieren autenticación y verificación del usuario.
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Subgrupo de rutas que requieren que el usuario tenga un estado específico.
    Route::middleware('check_user_status')->group(function () {

        // CRUD para el módulo de reportes.
        Route::resource('/reportes', ReportesController::class)->names('reportes');

        // CRUD para el módulo de coordinadores.
        Route::resource('/coordinador', CoordinadorController::class)->names('coordinador');

        // CRUD para el módulo de personal.
        Route::resource('/personals', PersonalsController::class)->names('personals');

        // Ruta para la vista principal del panel de administrador.
        Route::get('/admin', adminController::class)->name('admin');

        // Ruta para la búsqueda de direcciones.
        Route::get('/busqueda', [DireccionesController::class, 'index'])->name('busqueda');

        // Ruta para ver el informe general.
        Route::get('/informes', [InformesController::class, 'InfoGeneral'])->name('informes');

        // CRUD para el módulo de auditorías.
        Route::resource('/auditorias', AuditoriaController::class)->names('auditorias');

        // Ruta para confirmar anomalías detectadas.
        Route::get('/confirmadas', [FuntionController::class, 'anomaliasok'])->name('confirmadas');

        // CRUD para la verificación de reportes.
        Route::resource('/verificacion', ReportesverificacionController::class)->names('verificacion');

        // Ruta para exportar todos los reportes.
        Route::get('reportall', [FuntionController::class, 'exportReports'])->name('ExportarReportes');

        // Ruta para exportar los reportes revisados.
        Route::get('reportrevisados', [FuntionController::class, 'exportReportsRevisados'])->name('ExportarRevisados');
    });
});
