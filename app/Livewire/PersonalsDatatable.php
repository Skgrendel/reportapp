<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\personals;

class PersonalsDatatable extends DataTableComponent
{
    protected $model = personals::class;
    public ?string $searchPlaceholder = 'Buscar por documento';
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';

    public bool $viewingModal = false;
    public $currentModal;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setPerPage(10);
        $this->setConfigurableAreas([
            'toolbar-left-end' => 'personals.drop',
        ]);
        $this->setTableAttributes([
            'class' => 'table table-bordered custom-table',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Tipo documento", "tipodocumento.nombre"),
            Column::make("Numero documento", "numero_documento")
                ->sortable()
                ->searchable(),
            Column::make("Nombres", "nombres")
                ->sortable()
                ->searchable(),
            Column::make("Apellidos", "apellidos")
                ->sortable()
                ->searchable(),
            Column::make("Telefono", "telefono"),
            Column::make("Correo", "correo"),
            Column::make("Estado", "estado")
                ->format(
                    fn ($value, $row, Column $column) => match ($value) {
                        '0' =>'<span class="badge badge-danger">Cuenta Desactivada</span>',
                        '3' => '<span class="badge badge-success">Activo</span>',
                        '4' => '<span class="badge badge-danger">Inactivo</span>',
                    }
                )
                ->html(),
            Column::make("Creacion", "created_at")
                ->format(fn ($value) => $value->format('d/M/Y')),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('personals.actions', compact('value'))
                ),
        ];
    }

}
