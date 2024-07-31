<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class adminController extends Controller
{
    /**
     * Maneja la solicitud entrante y redirige a diferentes rutas según el rol del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // Verifica si el usuario tiene el rol 'Lector' y redirige a la página de reportes.
        if ($request->user()->hasRole('Lector')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        // Verifica si el usuario tiene el rol 'Coordinador' y redirige a la página de coordinadores.
        if ($request->user()->hasRole('Coordinador')) {
            return redirect()->action([CoordinadorController::class, 'index']);
        }

        // Verifica si el usuario tiene el rol 'Pno' y redirige a la página de auditorías.
        if ($request->user()->hasRole('Pno')) {
            return redirect()->action([AuditoriaController::class, 'index']);
        }

        // Verifica si el usuario tiene el rol 'Administrador' y redirige a la página de reportes.
        if ($request->user()->hasRole('Administrador')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        // Redirigir a otra ubicación si el usuario no tiene ninguno de los roles anteriores.
        // Puedes definir una ruta de fallback aquí si es necesario.
        // Ejemplo:
        // return redirect()->route('fallback.route');
    }
}
