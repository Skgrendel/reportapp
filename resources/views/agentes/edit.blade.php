<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modificacion de Contrato N°:@if ($reporte->contrato)
                {{ $reporte->contrato }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Tabs navigation-->
                <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-home01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-home01" data-twe-nav-active role="tab"
                            aria-controls="tabs-home01" aria-selected="true">Informacion</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-profile01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-profile01" role="tab"
                            aria-controls="tabs-profile01" aria-selected="false">Fotos</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="{{ route('reportes.index') }}"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            role="tab">regresar</a>
                    </li>

                </ul>

                <!--Tabs content-->
                <div class="mb-6">
                    <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-home01" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                        <div>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden px-6">
                                            <form action="{{ route('reportes.update', $reporte) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf
                                                <div class="mb-3">
                                                    <x-label for='observacion' value='Observacion del Coordinador'
                                                        class="mb-2" />
                                                    <textarea name="observacion" id="observacion" rows="5"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-400"
                                                        readonly>{{ $reporte->observaciones }}</textarea>
                                                    <x-input-error for="observacion" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="contrato" id="contrato"
                                                        placeholder="Ingrese su Numero de Contrato"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->contrato }}">
                                                    <x-input-error for="contrato" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="lectura" id="lectura"
                                                        placeholder="Ingrese su Numero de Lectura"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->lectura }}">
                                                    <x-input-error for="lectura" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-label for='anomalia' value='Observacion de Anomalia'
                                                        class="mb-2" />
                                                    <textarea name="anomalia" id="anomalia" rows="5"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        placeholder="Ingrese su Observacion">{{ $reporte->anomalia }}</textarea>
                                                    <x-input-error for="anomalia" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-label for="obstaculo" value="Imposibilidad de toma de lecturas"
                                                        class="mb-2" />
                                                    <div class="">
                                                        {{-- ninguna --}}
                                                        <div>
                                                            <label for="obstaculo">
                                                                <input type="radio" name="imposibilidad" id="obstaculo"
                                                                    value="ninguna" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'ninguna') checked @endif>
                                                                Ninguna
                                                            </label>
                                                        </div>
                                                        {{-- obstaculos --}}
                                                        <div>
                                                            <label for="obstaculo">
                                                                <input type="radio" name="imposibilidad" id="obstaculo"
                                                                    value="obstaculo" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'obstaculo') checked @endif>
                                                                Obstaculos
                                                            </label>
                                                        </div>
                                                        {{-- rejas --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad" id="reja"
                                                                    value="reja" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'reja') checked @endif>
                                                                Rejas
                                                            </label>
                                                        </div>
                                                        {{-- no medidor --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad" id="medidor"
                                                                    value="medidor" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'medidor') checked @endif>
                                                                Sin Medidor
                                                            </label>
                                                        </div>
                                                        {{-- usuario no lectura --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad" id="lectura_m"
                                                                    value="lectura" class="px-2"
                                                                    @if ($reporte->imposibilidad === 'lectura') checked @endif>
                                                                Usuario no Permite Lectura
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <x-label for="foto1" value="Fotos de Observacion"
                                                        class="mb-2" />
                                                    <input
                                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                        name="foto1" type="file" accept="image/*" />
                                                    <x-input-error for="foto1" />
                                                    <input
                                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                        name="foto2" type="file" accept="image/*" />
                                                    <x-input-error for="foto2" />
                                                    <input
                                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                        name="foto3" type="file" accept="image/*" />
                                                    <x-input-error for="foto3" />
                                                    <input
                                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                        name="foto4" type="file" accept="image/*" />
                                                    <x-input-error for="foto4" />
                                                    <input
                                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                        name="foto5" type="file" accept="image/*" />
                                                    <x-input-error for="foto5" />
                                                </div>
                                                <x-button class="mb-3">
                                                    Enviar
                                                </x-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-profile01" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                        <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-10 mb-6">
                            <div class="-m-1 flex flex-wrap md:-m-2">
                                @if ($reporte->foto1)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto1 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto2)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto2 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto3)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto3 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto4)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto4 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto5)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto5 }}" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
