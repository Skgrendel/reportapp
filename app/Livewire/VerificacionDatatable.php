<?php

namespace App\Livewire;
use App\Exports\ReportVerificacion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\vs_anomalias;
use App\Models\reportesverificacion;

class VerificacionDatatable extends DataTableComponent
{
    protected $model = reportesverificacion::class;
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';
    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => 'auditoria.export',
        ]);
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Exportar a Excel',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        $date = now()->format('Y-m-d H:i:s');

        return Excel::download(new ReportVerificacion($users), $date . '.xlsx');
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
                        $builder->where('reportesverificacions.estado', '5');
                    } elseif ($value === '7') {
                        $builder->where('reportesverificacions.estado', '7');
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
                        $builder->whereJsonContains('reportesverificacions.anomalia', '8');
                    } elseif ($value === '2') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '9');
                    } elseif ($value === '3') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '10');
                    } elseif ($value === '4') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '11');
                    } elseif ($value === '5') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '12');
                    } elseif ($value === '6') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '13');
                    } elseif ($value === '7') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '14');
                    } elseif ($value === '8') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '15');
                    } elseif ($value === '9') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '16');
                    } elseif ($value === '10') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '17');
                    } elseif ($value === '11') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '18');
                    } elseif ($value === '12') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '63');
                    } elseif ($value === '13') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '67');
                    } elseif ($value === '14') {
                        $builder->whereJsonContains('reportesverificacions.anomalia', '67');
                    }
                }),
        ];
    }
    public function builder(): Builder
    {
        return reportesverificacion::query()->whereIn('reportesverificacions.estado', [5]);
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
            Column::make("Estado", "estado")
                ->format(
                    fn ($value, $row, Column $column) => match ($value) {
                        '5' => '<span class="badge badge-warning">Verificado</span>',
                    }
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn ($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('verificacion.actions', compact('value'))
                ),
        ];
    }
}
