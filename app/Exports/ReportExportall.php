<?php

namespace App\Exports;

use App\Models\direcciones;
use App\Models\reportes;
use App\Models\vs_anomalias;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReportExportall implements FromCollection,WithHeadings
{
    protected $reporteIds;

    public function __construct($reporteIds)
    {
        $this->reporteIds = $reporteIds;
    }

    public function collection()
    {
        return reportes::with(['ComercioReporte', 'AnomaliaReporte','imposibilidadReporte','EstadoReporte','personal'])
        ->whereIn('id', $this->reporteIds)
        ->get()
        ->map(function ($reporte) {
            // Decodifica el JSON a un array de PHP
            $anomaliaIds = json_decode($reporte->anomalia);

            $ciclos = direcciones::where('contrato', $reporte->contrato)->value('ciclo');
            // Busca los nombres de las anomalías correspondientes a los IDs
            $anomaliaNombres = vs_anomalias::whereIn('id', $anomaliaIds)->pluck('nombre')->toArray();

            return [
                $reporte->contrato,
                $reporte->medidor,
                $reporte->medidor_anomalia,
                $reporte->direccion,
                implode(', ', $anomaliaNombres),
                $reporte->imposibilidadReporte->nombre,
                $reporte->ComercioReporte->nombre,
                $reporte->EstadoReporte->nombre,
                $ciclos,
                $reporte->created_at->format('Y-m-d'),
                $reporte->created_at->format('H:i:s '),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Contrato',
            'Medidor',
            'Medidor_anomalia',
            'Dirección',
            'Anomalía',
            'Imposibilidad',
            'Comercio',
            'Estado',
            'ciclo',
            'Fecha de Creación',
            'Hora de Creación',
        ];
    }
}
