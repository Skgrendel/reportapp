<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Agente'" :reportTitle="'Edicion de Reportes'" />
        <x-back-button route="{{ route('reportes.index') }}" />
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
                            aria-controls="tabs-profile01" aria-selected="false">Evidencias</a>
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
                                                enctype="multipart/form-data" id="myForm">
                                                @method('PUT')
                                                @csrf
                                                <input type="text" hidden id="latitud" name="latitud"
                                                    value="">
                                                <input type="text" hidden id="longitud" name="longitud"
                                                    value="">
                                                <input type="text" hidden name="personal_id"
                                                    value="{{ Auth::user()->personal->id }}">
                                                <div class="mt-2 " id="ubicacion">
                                                    <div class="p-4 mb-4 text-sm text-black-800 border border-black-300 rounded-lg"
                                                        role="alert">
                                                        <div class="flex items-center">
                                                            <span class="sr-only">Info</span>
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                                                                <div class="flex flex-col">
                                                                    <p>Datos Usuario: <br><strong>
                                                                            <span
                                                                                id="usuario">{{ $gis['info']['cliente'] ?? 'No hay Datos' }}</span>
                                                                    </p></strong>
                                                                    <p>Datos medidor: <br><strong><span
                                                                                id="medidorgis">{{ $gis['info']['medidor'] ?? 'No hay Datos' }}</span></strong>
                                                                    </p>
                                                                    <p>Categoria: <br><strong><span
                                                                                id="categoria">{{ $gis['info']['categoria'] ?? 'No hay Datos' }}</span></strong>
                                                                    </p>
                                                                    <p>Direccion: <br><strong><span
                                                                                id="direccion">{{ $gis['info']['direccion'] ?? 'No hay Datos' }}</span></strong>
                                                                    </p>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <p>Barrio: <br><strong><span
                                                                                id="barrio"></span>{{ $gis['info']['barrio'] ?? 'No hay Datos' }}</strong>
                                                                    </p>
                                                                    <p>Estado: <br><strong><span
                                                                                id="estado"></span>{{ $gis['info']['estado'] ?? 'No hay Datos' }}</strong>
                                                                    </p>
                                                                    <p>Corte: <br><strong><span
                                                                                id="estadoCorte"></span>{{ $gis['info']['estadoCorte'] ?? 'No hay Datos' }}</strong>
                                                                    </p>
                                                                    <p>Descripcion: <br><strong><span
                                                                                id="descripcion">{{ $gis['info']['descripcion'] ?? 'No hay Datos' }}</span></strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-end mt-4">
                                                            <a type="button" id="link" target="_blank"
                                                                href="https://www.google.com/maps/place/{{ $gis['geometry']['latitude'] . ',' . $gis['geometry']['longitude'] }}"
                                                                class="text-white bg-green-800 hover:bg-green-500/90 focus:ring-4 focus:outline-none focus:ring-green-800/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
                                                                Ver en Maps
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($reporte->observaciones)
                                                    <x-label for='observacion' value='Observaciones del Coordinador'
                                                        class="mb-2" />
                                                    <textarea id="observacion" rows="4" disabled
                                                        class="block mb-4  p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $reporte->observaciones }}</textarea>
                                                @endif
                                                <div class=" mb-3">
                                                    <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                                                    <input type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        name="contrato" id="contrato"
                                                        placeholder="Ingrese su Numero de Contrato"
                                                        value="{{ $reporte->contrato }}">
                                                    <x-input-error for="contrato" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                                                    <input type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        name="medidor" id="medidor"
                                                        placeholder="Ingrese su Numero de Medidor"
                                                        value="{{ $reporte->medidor }}">
                                                    <x-input-error for="medidor" />
                                                </div>
                                                <div class=" mb-3">
                                                    <div class="flex items-center mt-2 ">
                                                        <input id="medidor_noconcuerda" type="checkbox"
                                                            value=""
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="medidor_noconcuerda"
                                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">Medidor
                                                            No
                                                            Concuerda</label>
                                                        <input id="cambio" type="checkbox" value=""
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="cambio"
                                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cambio
                                                            de
                                                            Medidor</label>
                                                    </div>
                                                    <div id="medidor_anomalia" class="mt-2 hidden">
                                                        <x-label for='medidor2'
                                                            value='Numero de medidor que No Concuerda'
                                                            class="mb-2" />
                                                        <input type="text"
                                                            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 "
                                                            name="medidor_anomalia" id="medidor_anomalia"
                                                            placeholder="Ingrese su Numero de Medidor"
                                                            value="{{ $reporte->medidor_anomalia }}" readonly>
                                                        <x-input-error for="medidor_anomalia" />
                                                    </div>
                                                    <div id="medidor_cambio" class="mt-2 hidden">
                                                        <x-label for='medidor_cambio'
                                                            value='Motivo del Cambio de medidor' class="mb-2" />
                                                        <input type="text"
                                                            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 "
                                                            name="medidor_cambio" id="medidor_cambio"
                                                            placeholder="Observaciones "
                                                            value="{{ $reporte->medidor_cambio }}">
                                                        <x-input-error for="medidor_cambio" />
                                                    </div>
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='lectura' value='Numero de lectura'
                                                        class="mb-2" />
                                                    <input type="number"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        name="lectura" id="lectura"
                                                        placeholder="Ingrese su Numero de Lectura"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->lectura }}">
                                                    <x-input-error for="lectura" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='comercio' class="mb-2"
                                                        value="Tipo de Comercio" />
                                                    <select id="comercio" name="tipo_comercio"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3">
                                                        <option selected>Seleccione tipo de Comercio</option>
                                                        @foreach ($comercios as $id => $nombre)
                                                            <option value="{{ $id }}"
                                                                {{ $reporte->tipo_comercio == $id ? 'selected' : '' }}>
                                                                {{ $nombre }} </option>
                                                        @endforeach
                                                    </select>

                                                    <x-input-error for="comercio" />
                                                    <div id="div-comercio-nuevo" style="display: none;"
                                                        class=" flex">
                                                        <input type="text" name="nuevo_comercio" id="nueva_opcion"
                                                            class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                            value="{{ $reporte->nuevo_comercio }}">
                                                    </div>
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='nombre_comercio' value='Nombre Del Comercio'
                                                        class="mb-2" />
                                                    <input type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        name="nombre_comercio" id="nombre_comercio"
                                                        placeholder="Ingrese el Nombre Del Comercio Si lo requiere "
                                                        value="{{ $reporte->nombre_comercio }}">
                                                    <x-input-error for="nombre_comercio" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="anomalia"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opciones
                                                        de Anomalia</label>
                                                    <select id="anomalia" name="anomalia[]" multiple="multiple"
                                                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3"
                                                        placeholder="Seleccione su Anomalia">
                                                        @foreach ($anomalias as $id => $nombre)
                                                            <option
                                                                value="{{ $id }}"{{ in_array($id, $anomaliasIds) ? 'selected' : '' }}>
                                                                {{ $nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error for="anomalia" />
                                                </div>
                                                <div class="mb-4">
                                                    <label for="obstaculos" class="mb-4">Imposibilidad de toma de
                                                        Lectura</label>
                                                    <div class="mb-3">
                                                        <select id="obstaculos" name="imposibilidad"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected>Selecione su imposibilidad</option>
                                                            @foreach ($imposibilidad as $id => $nombre)
                                                                <option value="{{ $id }}"
                                                                    {{ $reporte->imposibilidad == $id ? 'selected' : '' }}>
                                                                    {{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error for="obstaculos" />
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="mb-3">
                                                        <label for="comentarios"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comentarios
                                                        </label>
                                                        <textarea id="comentarios" name="comentarios" rows="4"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $reporte->comentarios }}</textarea>
                                                        <x-input-error for="comentarios" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    {{-- <div id="video_evidencia" class=" hidden mb-3">
                                                        <label for="foto7" id="label_help7"
                                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                            </svg>
                                                            <h2
                                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                Video de Anomalia</h2>
                                                            <p id="elemento_7"
                                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                sube tu video en formato MP4 </p>
                                                            <input id="foto7" name="video" type="file"
                                                                class="hidden" accept="video/*" />
                                                        </label>
                                                    </div> --}}
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <!-- Elemento 1 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto1" id="label_help1"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Foto del Inmueble</h2>
                                                                    <p id="elemento_1"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        sube la foto en formato JPEG </p>
                                                                    <input id="foto1" name="foto1"
                                                                        type="file" class="hidden"
                                                                        accept="image/jpeg;camara=user" />
                                                                    <x-input-error for="foto1" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Elemento 2 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto2" id="label_help2"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Numero de Serial</h2>

                                                                    <p id="elemento_2"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        Realiza la foto en formato JPEG </p>

                                                                    <input id="foto2" name="foto2"
                                                                        type="file" class="hidden"
                                                                        capture="camera" accept="image/jpeg" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Elemento 3 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto3" id="label_help3"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Numero de Lectura</h2>

                                                                    <p id="elemento_3"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        Realiza la foto en formato JPEG </p>

                                                                    <input id="foto3" name="foto3"
                                                                        type="file" class="hidden"
                                                                        capture="camera" accept="image/*" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Elemento 4 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto4" id="label_help4"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Numero del Medidor</h2>

                                                                    <p id="elemento_4"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        Realiza la foto en formato JPEG </p>

                                                                    <input id="foto4" name="foto4"
                                                                        type="file" class="hidden"
                                                                        capture="camera" accept="image/*" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Elemento 5 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto5" id="label_help5"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Estado del Medidor</h2>

                                                                    <p id="elemento_5"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        Realiza la foto en formato JPEG </p>

                                                                    <input id="foto5" name="foto5"
                                                                        type="file" class="hidden"
                                                                        capture="camera" accept="image/*" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Elemento 6 -->
                                                        <div>
                                                            <div>
                                                                <label for="foto6" id="label_help6"
                                                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                                    </svg>
                                                                    <h2
                                                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                                        Opcional</h2>

                                                                    <p id="elemento_6"
                                                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                                        Realiza la foto en formato JPEG </p>

                                                                    <input id="foto6" name="foto6"
                                                                        type="file" class="hidden"
                                                                        capture="camera" accept="image/*" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <button type="submit" id="submitButtonEvidencias"
                                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Enviar</button>
                                                    <div class="d-flex hidden w-full" role="alert"
                                                        id="progressBarEvidencias">
                                                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 flex items-center w-full"
                                                            role="alert">
                                                            <div role="status" class="flex items-center">
                                                                <svg aria-hidden="true"
                                                                    class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-green-600"
                                                                    viewBox="0 0 100 101" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                                        fill="currentFill" />
                                                                </svg>
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                            <span class="font-medium ml-4">Cargando Archivos!! Esto
                                                                Puede demorar unos Minutos
                                                                Espere...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-profile01" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                        <div class="px-5 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                @foreach (range(1, 6) as $i)
                                    @if ($reporte->{'foto' . $i})
                                        <div class="relative">
                                            <img alt="gallery" class="h-auto max-w-full rounded-lg"
                                                src="/imagen/{{ $reporte->{'foto' . $i} }}" />
                                            <div class="absolute top-0 left-0 bg-black bg-opacity-50 text-white p-2">
                                                @switch($i)
                                                    @case(1)
                                                        <p class="text-sm">Foto del inmueble</p>
                                                    @break

                                                    @case(2)
                                                        <p class="text-sm">Numero del Serial</p>
                                                    @break

                                                    @case(3)
                                                        <p class="text-sm">Numero de Lectura</p>
                                                    @break

                                                    @case(4)
                                                        <p class="text-sm">Numero del Medidor</p>
                                                    @break

                                                    @case(5)
                                                        <p class="text-sm">Estado del Medidor</p>
                                                    @break

                                                    @case(6)
                                                        <p class="text-sm">Opcional</p>
                                                    @break
                                                @endswitch
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="w-full flex justify-center items-center">
                                <div style="max-width: 50%;" class=" text-center">
                                    <span class="mb-3">Video de Anomalias</span>
                                    <video width="100%" height="auto" controls>
                                        <source src="{{ asset('video/' . $reporte['video']) }}" type="video/mp4">
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            document.getElementById("comercio").addEventListener("change", function() {
                var divComercioNuevo = document.getElementById("div-comercio-nuevo");
                if (this.value == "56") {
                    divComercioNuevo.style.display = "block";
                } else {
                    divComercioNuevo.style.display = "none";
                }
            });
        </script>


        <script>
            $(document).ready(function() {
                $('#myForm').submit(function(e) {
                    $('#submitButtonEvidencias').addClass('hidden');
                    $('#progressBarEvidencias').removeClass('hidden');
                });
            });
        </script>

        <script>
            document.querySelectorAll('.grid img').forEach(img => {
                img.addEventListener('click', function() {
                    openModal(this.src);
                });
            });

            function openModal(imageSrc) {
                // Crear el modal
                let modal = document.createElement('div');
                modal.classList.add('modal');
                modal.style.display = 'flex';
                modal.style.position = 'fixed';
                modal.style.zIndex = '1000';
                modal.style.left = '0';
                modal.style.top = '0';
                modal.style.width = '100%';
                modal.style.height = '100%';
                modal.style.overflow = 'auto';
                modal.style.backgroundColor = 'rgba(0,0,0,0)';
                modal.style.justifyContent = 'center';
                modal.style.alignItems = 'center';

                // Crear la imagen
                let img = document.createElement('img');
                img.src = imageSrc;
                img.style.display = 'block';
                img.style.margin = 'auto';
                img.style.maxWidth = '80%';
                img.style.maxHeight = '80%';
                img.style.borderRadius = '10px'; // Agregar bordes redondeados a la imagen
                img.style.cursor = 'pointer'; // Cambiar el cursor a un puntero de mano

                // Agregar la imagen al modal
                modal.appendChild(img);

                // Agregar el modal al body
                document.body.appendChild(modal);

                // Cambiar la opacidad del modal a 1 para mostrarlo
                setTimeout(function() {
                    modal.style.backgroundColor = 'rgba(0,0,0,0.4)';
                }, 0);

                // Cerrar el modal cuando se hace clic en él
                modal.addEventListener('click', function() {
                    modal.style.backgroundColor = 'rgba(0,0,0,0)';
                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 200);
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>

        <script>
            for (let i = 1; i <= 7; i++) {
                const fileInput = document.getElementById(`foto${i}`);
                const fileInputHelp = document.getElementById(`elemento_${i}`);
                const labelHelp = document.getElementById(`label_help${i}`);
                const originalText = fileInputHelp.innerText;

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileInputHelp.innerText = 'Archivo cargado.';
                        fileInputHelp.style.color = 'white';
                        labelHelp.classList.remove('bg-white');
                        labelHelp.classList.add('bg-green-500');
                    } else {
                        fileInputHelp.innerText = originalText;
                        fileInputHelp.style.color = 'initial';
                        labelHelp.classList.remove('bg-green-500');
                        labelHelp.classList.add('bg-white');
                    }
                });
            }
        </script>

        <script>
            // Función para manejar la obtención de la ubicación actual
            function obtenerUbicacion() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Obtener latitud y longitud
                    var latitud = position.coords.latitude;
                    var longitud = position.coords.longitude;

                    // Colocar latitud y longitud en los elementos de entrada
                    document.getElementById('latitud').value = latitud;
                    document.getElementById('longitud').value = longitud;
                });
            }
            // Llamar a la función para obtener la ubicación al cargar la página
            window.onload = obtenerUbicacion;
        </script>
        <script>
            document.getElementById('medidor_noconcuerda').addEventListener('change', function() {
                var medidorAnomalia = document.getElementById('medidor_anomalia');
                if (this.checked) {
                    medidorAnomalia.classList.remove("hidden");
                } else {
                    medidorAnomalia.classList.add("hidden");
                }
            });
        </script>

        <script>
            document.getElementById('cambio').addEventListener('change', function() {
                var medidorAnomalia = document.getElementById('medidor_cambio');
                if (this.checked) {
                    medidorAnomalia.classList.remove("hidden");
                } else {
                    medidorAnomalia.classList.add("hidden");
                }
            });
        </script>
    @endsection
</x-app-layout>
