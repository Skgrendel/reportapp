<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Agentes'" :reportTitle="' Toma de Lecturas '" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div>
                        <a href="{{ route('reportes.create') }}"
                            class="inline-flex mb-4 items-center px-4 py-2 bg-gradient-to-tl from-blue-500 to-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-folder-plus mr-2"></i> Agregar Reporte
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
                        @if ($historiales->isEmpty())
                            <div class="text-center py-3">
                                <p class="text-gray-500">No hay reportes activos</p>
                            </div>
                        @endif
                        @foreach ($historiales as $historial)
                            <div class="w-full max-w-full px-2 mb-4 sm:w-full sm:flex-none xl:mb-0 xl:w-full">
                                <div
                                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl  rounded-2xl bg-clip-border">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-row -mx-3">
                                            <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase "
                                                        aria-describedby="contrato">Contrato N°:
                                                        {{ $historial->contrato }}</p>
                                                    <p class="mt-1 text-sm text-gray-500" id="contrato">Fecha:
                                                        {{ $historial->created_at }}</p>
                                                    <p class="mt-1 text-sm text-gray-500 mb-3" id="contrato">Estado:
                                                        @switch($historial->EstadoReporte->id)
                                                            @case(5)
                                                                <span
                                                                    class="bg-orange-300 text-white px-2 py-1 rounded-full">Pendiente</span>
                                                            @break

                                                            @case(7)
                                                                <span
                                                                    class="bg-red-500 text-white px-2 py-1 rounded-full">Rechazado</span>
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </p>
                                                    <div class="flex">
                                                        @if ($historial->estado != 7)
                                                        <p class="mb-0  mr-2">
                                                            <a class="text-sm font-bold leading-normal text-emerald-500"
                                                                href="{{ route('reportes.show', $historial->id) }}">
                                                                <i class="far fa-eye"></i> Ver informacion
                                                            </a>
                                                        </p>
                                                        @endif
                                                        @if ($historial->estado == 7)
                                                            <p class="mb-0 ">
                                                                <a class="text-sm font-bold leading-normal text-orange-500"
                                                                    href="{{ route('reportes.edit', $historial->id) }}">
                                                                    <i class="fas fa-search"></i> Revisar
                                                                </a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @switch($historial->EstadoReporte->id)
                                                @case(5)
                                                    <div class="px-3 text-right basis-1/3">
                                                        <div
                                                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                                            <i class="fas fa-history text-lg relative top-3.5 text-white"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @case(7)
                                                    <div class="px-3 text-right basis-1/3 ">
                                                        <div
                                                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-500 to-orange-500">
                                                            <i
                                                                class="fas fa-exclamation-circle text-lg relative top-3.5 text-white"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @default
                                                    <div class="px-3 text-right basis-1/3">
                                                        <div
                                                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-green-500 to-blue-500">
                                                            <i
                                                                class="fas fa-check-circle text-lg relative top-3.5 text-white"></i>
                                                        </div>
                                                    </div>
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
