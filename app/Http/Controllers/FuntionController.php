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

    public function BuscarContrato($id)
    {
        $gis = $this->info->DataGisubicacion($id);

        if (isset($gis) && isset($gis['geometry'])) {
            // Verificar si la clave 'geometry' existe en el array $gis
        $latitude = isset($gis['geometry']['latitude']) ? $gis['geometry']['latitude'] : null;
        $longitude = isset($gis['geometry']['longitude']) ? $gis['geometry']['longitude'] : null;

           if ($latitude && $longitude) {
            $medidor = direcciones::where('contrato', $id)->first();
            $src = $latitude . ',' . $longitude;
            return response()->json([
                'info'=>'Gis',
                'src' => $src,
                'gis' => $gis['info'] ? $gis['info'] : $medidor,
                'medidor' => $medidor ? $medidor->medidor : 'No disponible'
            ]);
        } else {
            return response()->json([
                'error' => 'Datos de ubicación incompletos',
                'details' => 'Las coordenadas de latitud o longitud están ausentes.'
            ], 400); // Código de error 400 para solicitud incorrecta
        }
        } else {

            $data = direcciones::where('contrato', $id)->first();
            $latitude = isset($data->latitud) ? $data->latitud : null;
            $longitude = isset($data->longitud) ? $data->longitud : null;
            $src = $latitude . ',' . $longitude;

            return response()->json([
                'info'=>'Surtigas',
                'src' => $src,
                'gis' => $data ? $data : 'No disponible',
                'medidor' => $data ? $data->medidor : 'No disponible'
            ]);
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
