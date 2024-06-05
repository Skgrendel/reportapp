<?php

namespace App\Exports;

use App\Models\direcciones;
use App\Models\reportesverificacion;
use App\Models\vs_anomalias;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReportVerificacion implements FromCollection,WithHeadings
{
    protected $reporteIds;

    public function __construct($reporteIds)
    {
        $this->reporteIds = $reporteIds;
    }

    public function collection()
    {
        return reportesverificacion::with(['ComercioReporte', 'AnomaliaReporte','imposibilidadReporte','EstadoReporte','personal'])
        ->whereIn('id', $this->reporteIds)
        ->get()
        ->map(function ($reporte) {
            // Decodifica el JSON a un array de PHP
            $anomaliaIds = json_decode($reporte->anomalia);

            $ciclos = direcciones::where('contrato', $reporte->contrato)->value('ciclo');
            // Busca los nombres de las anomalías correspondientes a los IDs
            $anomaliaNombres = vs_anomalias::whereIn('id', $anomaliaIds)->pluck('nombre')->toArray();

            return [
                $reporte->personal->nombres,
                $reporte->personal->apellidos,
                $reporte->contrato,
                $reporte->medidor,
                $reporte->lectura,
                $reporte->direccion,
                $ciclos,
                implode(', ', $anomaliaNombres),
                $reporte->imposibilidadReporte->nombre,
                $reporte->ComercioReporte->nombre,
                $reporte->EstadoReporte->nombre,
                $reporte->created_at->format('Y-m-d'),
                $reporte->created_at->format('H:i:s '),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombres',
            'Apellidos',
            'Contrato',
            'Medidor',
            'Lectura',
            'Dirección',
            'ciclo',
            'Anomalía',
            'Imposibilidad',
            'Comercio',
            'Estado',
            'Fecha de Creación',
            'Hora de Creación',
        ];
    }
}
