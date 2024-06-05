<?php

namespace App\Http\Controllers;

use App\Exports\ReportExportall;
use App\Exports\ReportVerificacion;
use App\Models\direcciones;
use App\Models\reportes;
use App\Models\reportesverificacion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FuntionController extends Controller
{
    public function BuscarContrato($id)
    {
        $contrato = direcciones::where('contrato', $id)->first(); // Busca el contrato con ese id

        if ($contrato) {
            $src = $contrato->latitud . ',' . $contrato->longitud;
            return response()->json(['src' => $src, 'contrato' => $contrato]); // Si el contrato existe, devuelve sus datos como JSON
        } else {
            return response()->json(['error' => 'Contrato no encontrado'], 404); // Si no existe, devuelve un error
        }
    }

    public function exportReports()
    {
        $reporteIds = reportes::pluck('id')->toArray(); // Get all report IDs

        return Excel::download(new ReportExportall($reporteIds), 'reportes.xlsx');
    }

    public function exportReportsRevisados()
    {
        $reporteIds = reportesverificacion::pluck('id')->toArray(); // Get all report IDs

        return Excel::download(new ReportVerificacion($reporteIds), 'reportes.xlsx');
    }
}
