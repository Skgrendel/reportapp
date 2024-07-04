<?php

namespace App\Http\Controllers;

use App\Exports\ReportExportall;
use App\Exports\ReportVerificacion;
use App\Models\direcciones;
use App\Models\reportes;
use App\Models\reportesverificacion;
use App\Services\DataGisServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FuntionController extends Controller
{
    private  $info;

    public function __construct()
    {
        $this->info = new DataGisServices();
    }

    public function BuscarContrato(string $id)
    {
        $medidor = direcciones::where('contrato', $id)->get();
        $gis = $this->info->DataGisubicacion($id);

        if ($gis) {
            $src =   $gis['geometry']['latitude']   . ',' .  $gis['geometry']['longitude'];
            return response()->json(['src' => $src, 'gis' => $gis['info'], 'medidor' => $medidor->medidor]); // Si el contrato existe, devuelve sus datos como JSON
        } else {
            return response()->json(['error' => 'Contrato no encontrado'], 404); // Si no existe, devuelve un error
        }
    }

    public function exportReports()
    {
        $reporteIds = reportes::pluck('id')->toArray(); // Get all report IDs
        $filename = now()->format('Y-m-d H:i:s') . '.xlsx';
        return Excel::download(new ReportExportall($reporteIds), $filename);
    }

    public function exportReportsRevisados()
    {
        $reporteIds = reportesverificacion::pluck('id')->toArray(); // Get all report IDs
        $filename = now()->format('Y-m-d H:i:s') . '.xlsx';
        return Excel::download(new ReportVerificacion($reporteIds), $filename);
    }

    public function anomaliasok()
    {
        return view('auditoria.confirmado');
    }
}
