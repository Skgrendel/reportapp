<?php

namespace App\Livewire;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\vs_anomalias;
use App\Models\reportes;

class ReportesDatatable extends DataTableComponent
{
    protected $model = reportes::class;
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';
    public ?string $defaultSortColumn = 'created_at';


    public function configure(): void
    {
        $this->setPrimaryKey('id')->setTableRowUrl(function($row) {
            return route('coordinador.show',['coordinador' => $row]);
        });
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => 'coordinador.export',
        ]);
        $this->setTableAttributes([
            'class' => 'table table-bordered  custom-table',
        ]);
    }

    public function bulkActions(): array
    {
        return [
            'exporta' => 'Exportar a Excel',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        $date = now()->format('Y-m-d H:i:s');

        return Excel::download(new ReportExport($users), $date . '.xlsx');
    }


    public function filters(): array
    {
        return [
            SelectFilter::make('Estados')
                ->options([
                    '' => 'All',
                    '5' => 'Pendientes',
                    '7' => 'Rechazados',
                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '5') {
                        $builder->where('reportes.estado', '5');
                    } elseif ($value === '7') {
                        $builder->where('reportes.estado', '7');
                    }
                }),
                SelectFilter::make('Ciclos')
                ->options([
                    '' => 'All',
                    '1' => '1001',
                    '2' => '1002',
                    '3' => '1003',
                    '4' => '1004',
                    '5' => '1005',
                    '6' => '1006',
                    '7' => '1007',
                    '8' => '1008',
                    '9' => '1009',
                    '10' => '1010',
                    '11' => '1011',
                    '12' => '1012',
                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '1') {
                        $builder->where('ciclos.ciclo', '1001');
                    } elseif ($value === '2') {
                        $builder->where('ciclos.ciclo', '1002');
                    } elseif ($value === '3') {
                        $builder->where('ciclos.ciclo', '1003');
                    } elseif ($value === '4') {
                        $builder->where('ciclos.ciclo', '1004');
                    } elseif ($value === '5') {
                        $builder->where('ciclos.ciclo', '1005');
                    } elseif ($value === '6') {
                        $builder->where('ciclos.ciclo', '1006');
                    } elseif ($value === '7') {
                        $builder->where('ciclos.ciclo', '1007');
                    } elseif ($value === '8') {
                        $builder->where('ciclos.ciclo', '1008');
                    } elseif ($value === '9') {
                        $builder->where('ciclos.ciclo', '1009');
                    } elseif ($value === '10') {
                        $builder->where('ciclos.ciclo', '1010');
                    } elseif ($value === '11') {
                        $builder->where('ciclos.ciclo', '1011');
                    } elseif ($value === '12') {
                        $builder->where('ciclos.ciclo', '1012');
                    }
                }),
            SelectFilter::make('Anomalias')
                ->options([
                    '' => 'All',
                    '1' => 'Sin anomalias',
                    '2' => 'Bypass',
                    '3' => 'Medidor con sellos manipulados',
                    '4' => 'Medidor con digitos desalineados',
                    '5' => 'Medidor sin talco',
                    '6' => 'Medidor enterrado',
                    '7' => 'Conexión directa',
                    '8' => 'Medidor frenado',
                    '9' => 'Medidor gira hacia atrás',
                    '10' => 'Medidor fuera de ruta',
                    '11' => 'Medidor trocado',
                    '12' => 'Inactivo y en Consumo',
                    '13' => 'Medidor no encontrado',
                    '14' => 'Medidor no concuerda con el contrato',
                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '1') {
                        $builder->whereJsonContains('reportes.anomalia', '8');
                    } elseif ($value === '2') {
                        $builder->whereJsonContains('reportes.anomalia', '9');
                    } elseif ($value === '3') {
                        $builder->whereJsonContains('reportes.anomalia', '10');
                    } elseif ($value === '4') {
                        $builder->whereJsonContains('reportes.anomalia', '11');
                    } elseif ($value === '5') {
                        $builder->whereJsonContains('reportes.anomalia', '12');
                    } elseif ($value === '6') {
                        $builder->whereJsonContains('reportes.anomalia', '13');
                    } elseif ($value === '7') {
                        $builder->whereJsonContains('reportes.anomalia', '14');
                    } elseif ($value === '8') {
                        $builder->whereJsonContains('reportes.anomalia', '15');
                    } elseif ($value === '9') {
                        $builder->whereJsonContains('reportes.anomalia', '16');
                    } elseif ($value === '10') {
                        $builder->whereJsonContains('reportes.anomalia', '17');
                    } elseif ($value === '11') {
                        $builder->whereJsonContains('reportes.anomalia', '18');
                    } elseif ($value === '12') {
                        $builder->whereJsonContains('reportes.anomalia', '63');
                    } elseif ($value === '13') {
                        $builder->whereJsonContains('reportes.anomalia', '67');
                    } elseif ($value === '14') {
                        $builder->whereJsonContains('reportes.anomalia', '67');
                    }
                }),
        ];
    }
    public function builder(): Builder
    {
        return reportes::query()->whereIn('reportes.estado', [5, 7])
            ->with(['personal', 'ComercioReporte', 'ciclos']);
    }


    public function columns(): array
    {
        return [
            Column::make("Nombres", "personal.nombres"),
            Column::make("Apellidos", "personal.apellidos"),
            Column::make("Contrato", "contrato")
                ->collapseOnMobile()
                ->searchable(),
            Column::make("Lectura", "lectura")
                ->collapseOnMobile(),
            Column::make("Anomalia", "anomalia")
                ->format(function ($value) {
                    $ids = json_decode($value); // Decodifica el JSON
                    $nombres = [];
                    foreach ($ids as $id) {
                        $anomalia = vs_anomalias::find($id); // Busca la Anomalia por ID
                        if ($anomalia) {
                            $nombres[] = $anomalia->nombre; // Agrega el nombre a la lista
                        }
                    }
                    return implode(', ', $nombres); // Devuelve los nombres como una cadena separada por comas
                })
                ->collapseOnMobile(),
            Column::make("Direccion", "direccion")
                ->collapseAlways(),
            Column::make("Comercio", "ComercioReporte.nombre")
                ->collapseAlways(),
            Column::make('Ciclos', 'ciclos.ciclo')
                ->searchable(),
            Column::make("Estado", "estado")
                ->format(
                    fn ($value, $row, Column $column) => match ($value) {
                        '5' => '<span class="badge badge-warning">Pendiente</span>',
                        '6' => '<span class="badge badge-success">Revisado</span>',
                        '7' => '<span class="badge badge-danger">Rechazado</span>',
                    }
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn ($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
            ->unclickable()
                ->format(
                    fn ($value, $row, Column $column) => view('coordinador.actions', compact('value'))
                ),
        ];
    }
}
