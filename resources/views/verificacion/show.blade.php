@extends('layouts.frontpage.app')

@section('content')
    <div class="widget-content widget-content-area">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    @if ($validate === null)
                                        <span class="badge bg-danger badge-dot"></span>
                                    @else
                                        <div class="badge badge-success badge-dot"></div>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="media-title">Numero de Contrato:
                                                    <strong>{{ $reporte->contrato }} @if ($validate === null)
                                                            <span class="text-danger">No REGISTRA en base de datos</span>
                                                        @endif
                                                    </strong> </span>
                                            </div>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>

                                    <li>
                                        <span class="text-card text-sm"> Numero del Medidor: {{ $reporte->medidor }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Numero de Lectura: {{ $reporte->lectura }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Tipo de Comercio:
                                            {{ $reporte->ComercioReporte->nombre }}</span>
                                        @if ($reporte->nuevo_comercio)
                                            <span class="text-card text-sm"> Comercio: {{ $reporte->nuevo_comercio }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <span class="text-card text-sm">{{ $reporte->imposibilidadReporte->nombre }}</span>
                                    </li>
                                    @foreach ($anomalias as $anomalia)
                                        <li>
                                            <span class="text-card text-sm">{{ $anomalia->nombre }}</span>

                                        </li>
                                    @endforeach
                                    <li>
                                        <span class="text-card text-sm">Medidor Encontrado:
                                            {{ $reporte->medidor_anomalia }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm">Nombre del Comercio:
                                            {{ $reporte->nombre_comercio }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <span class="text-card mb-2"> <strong>Comentarios del Agente de Campo</strong></span><br>
                            <div class="text-card text-sm">{{ $reporte->comentarios }}</div>
                        </div>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 100%;background:#0E1726"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="{{ route('verificacion.edit', $reporte->id) }}" class="bs-tooltip rounded  me-4"
                            data-bs-placement="top" title="Descargar Informe">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 8"
                                id="File-Report--Streamline-Plump" height="30" width="30">
                                <desc>File Report Streamline Icon: https://streamlinehq.com</desc>
                                <g id="file-report">
                                    <path id="Subtract" fill="#000000" fill-rule="evenodd"
                                        d="M1.6077233333333334 0.36517999999999995C2.0875166666666667 0.30920499999999995 2.86355 0.25 3.9999833333333332 0.25c0.33086666666666664 0 0.6311833333333333 0.005018333333333333 0.9025166666666666 0.013513333333333332 0.02253333333333333 0.0007066666666666666 0.04488333333333333 0.004458333333333333 0.06641666666666667 0.011156666666666665 0.19106666666666666 0.05941833333333333 0.7045833333333333 0.27210999999999996 1.4230666666666665 0.9727883333333334 0.6770333333333333 0.660275 0.9107166666666666 1.144025 0.9871166666666666 1.3559083333333333 0.008733333333333333 0.024249999999999997 0.013683333333333334 0.0497 0.01465 0.07546666666666665 0.014066666666666667 0.3768833333333333 0.022883333333333332 0.8149666666666666 0.022883333333333332 1.3211833333333334 0 1.3515833333333334 -0.06281666666666666 2.217783333333333 -0.12104999999999999 2.7306 -0.054883333333333326 0.4831833333333333 -0.42198333333333327 0.8480666666666666 -0.9033333333333333 0.9042166666666667 -0.4798 0.05598333333333333 -1.2558333333333334 0.11518333333333333 -2.3922666666666665 0.11518333333333333s-1.9124666666666665 -0.0592 -2.39226 -0.11518333333333333c-0.48135666666666665 -0.05614999999999999 -0.8484583333333333 -0.42103333333333326 -0.9033316666666666 -0.9042166666666667C0.6461516666666667 6.2178 0.5833333333333333 5.3515999999999995 0.5833333333333333 4.000016666666666c0 -1.3516 0.06281833333333334 -2.2178 0.12105833333333334 -2.7306150000000002 0.05487333333333333 -0.48317666666666664 0.42197666666666667 -0.8480650000000001 0.9033316666666666 -0.9042216666666666ZM2.1666666666666665 6.625c-0.16108333333333333 0 -0.29166666666666663 -0.13058333333333333 -0.29166666666666663 -0.29166666666666663s0.13058333333333333 -0.29166666666666663 0.29166666666666663 -0.29166666666666663h3.6666666666666665c0.16108333333333333 0 0.29166666666666663 0.13058333333333333 0.29166666666666663 0.29166666666666663s-0.13058333333333333 0.29166666666666663 -0.29166666666666663 0.29166666666666663H2.1666666666666665ZM1.875 5.166666666666666c0 -0.16108333333333333 0.13058333333333333 -0.29166666666666663 0.29166666666666663 -0.29166666666666663h3.6666666666666665c0.16108333333333333 0 0.29166666666666663 0.13058333333333333 0.29166666666666663 0.29166666666666663s-0.13058333333333333 0.29166666666666663 -0.29166666666666663 0.29166666666666663H2.1666666666666665c-0.16108333333333333 0 -0.29166666666666663 -0.13058333333333333 -0.29166666666666663 -0.29166666666666663Zm2.6994833333333332 -3.2992833333333333c0.4072 -0.07713333333333333 0.7632999999999999 -0.07988333333333333 0.9529833333333333 -0.07351666666666666 0.18894999999999998 0.00635 0.33901666666666663 0.15641666666666665 0.34536666666666666 0.34536666666666666 0.006366666666666666 0.18968333333333331 0.0036166666666666665 0.5457833333333333 -0.07353333333333333 0.9529833333333333 -0.05764999999999999 0.3043666666666667 -0.42095 0.3838333333333333 -0.6194166666666666 0.18538333333333334l-0.1898 -0.18981666666666666c-0.0106 0.009116666666666665 -0.023866666666666665 0.020616666666666665 -0.03945 0.03431666666666666 -0.04488333333333333 0.039466666666666664 -0.10868333333333333 0.09701666666666665 -0.18306666666666666 0.1681333333333333 -0.1498 0.1432 -0.33785 0.3371166666666666 -0.50035 0.5464833333333333 -0.12243333333333334 0.15776666666666667 -0.31133333333333335 0.20385 -0.46541666666666665 0.17996666666666666 -0.15514999999999998 -0.024066666666666667 -0.3271166666666666 -0.12833333333333333 -0.38845 -0.32886666666666664 -0.06083333333333333 -0.19893333333333332 -0.13829999999999998 -0.42946666666666666 -0.2191833333333333 -0.6172666666666666 -0.1757 0.13251666666666667 -0.45315 0.3957333333333333 -0.7834 0.9004833333333333 -0.0882 0.13479999999999998 -0.26896666666666663 0.17256666666666667 -0.40376666666666666 0.08436666666666666 -0.1347833333333333 -0.0882 -0.17256666666666667 -0.26896666666666663 -0.08436666666666666 -0.40374999999999994 0.4479833333333333 -0.6846666666666665 0.8349 -1.0053166666666666 1.07405 -1.15225 0.2514666666666666 -0.1544833333333333 0.5498999999999999 -0.04103333333333333 0.6676 0.1976 0.09468333333333334 0.19193333333333332 0.18224999999999997 0.4327 0.25195 0.6462333333333333 0.15586666666666665 -0.18541666666666667 0.3180166666666666 -0.3501666666666666 0.4482 -0.4746333333333333 0.08113333333333334 -0.07756666666666666 0.151 -0.14058333333333334 0.20093333333333332 -0.1845l0.011199999999999998 -0.009833333333333333 -0.18746666666666667 -0.18745c-0.19846666666666668 -0.19846666666666668 -0.11898333333333333 -0.5617666666666666 0.18538333333333334 -0.6194333333333333Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                        </a>
                        @if ($reporte->revisado == 1)
                            <span class="badge bg-success">Este reporte ya se encuentra verificado</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="text-card">Datos del Usuario
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @if (isset($gis['info']))
                            <div class="row mt-2">
                                <div class="text-card text-sm col-6">
                                    <ul>
                                        <li class="mb-2">
                                            Usuario :
                                            {{ $gis['info']['usuario'] ?? ('sin datos' . ' ' . $gis['info']['apellido'] ?? 'sin datos') }}
                                        </li>
                                        <li class="mb-2">
                                            Direccion: {{ $gis['info']['direccion'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Barrio: {{ $gis['info']['barrio'] ?? 'sin datos' }}
                                        </li>
                                        <li>
                                            Categoria: {{ $gis['info']['categoria'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-card text-sm col-6">
                                    <ul>
                                        <li class="mb-2">
                                            Contrato: {{ $gis['info']['contrato'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Medidor : {{ $gis['info']['medidor'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Estado: {{ $gis['info']['estado'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Descripcion: {{ $gis['info']['descripcion'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-card">
                                    <ul>
                                        <li>
                                            Estado de Conexion: {{ $gis['info']['estadoCorte'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <p>{{ $gis['error'] }}</p>
                        @endif
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 100%;background:#0E1726"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            @if ($reporte->revisado != 1)
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card style-4" style="width: 100%; height: 100%;">
                        <div class="card-body pt-3">
                            <div class="m-o-dropdown-list">
                                <div class="media mt-0 mb-3">
                                    <div class="badge--group me-3">
                                        <div class="badge badge-success badge-dot"></div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading mb-0">
                                            <span class="media-title">Observaciones</span>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                            <div class="row">
                                <form action="{{ route('verificacion.destroy', $reporte->id) }}" method="post"
                                    id="observacion" enctype="multipart/form-data">
                                    @method('DELETE')
                                    @csrf
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="NoEncontrado"
                                            name="revisado" value="1">
                                        <label class="form-check-label" for="NoEncontrado">No Encontrado</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="Encontrado"
                                            name="revisado" value="0">
                                        <label class="form-check-label" for="Encontrado">Encontrado</label>
                                    </div>
                                    <div class="alert alert-warning d-none" role="alert" id="progressBarObservacion">
                                        <span class="text-sm">Guardando Cambios Porfavor Espere.....</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class=" d-flex justify-content-end">
                                        <button type="submit" id="submitButtonObservacion"
                                            class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="text-card">Subir Evidencias</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row">
                            <form action="{{ route('verificacion.update', $reporte->id) }}" method="POST"
                                enctype="multipart/form-data" id="evidencias">
                                @method('PUT')
                                @csrf
                                <input type="text" name="id" value="{{ $reporte->id }}" hidden>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-1 ">
                                            <input type="file" class="form-control " id="foto1" name="foto1"
                                                accept="image/jpeg">
                                            <span class="input-group-text" id="foto1">Inmueble</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto2" name="foto2"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto2">Numero Serial</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto3" name="foto3"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto3">Numero Lectura</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto4" name="foto4"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto4">Numero Medidor</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto5" name="foto5"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto5">Estado Medidor</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto6" name="foto6"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto6">Opcional</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="video" name="video"
                                                accept="video/mp4">
                                            <span class="input-group-text" id="video">video</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert">
                                </div>
                                <div class="alert alert-warning d-none" role="alert" id="progressBarEvidencias">
                                    <span class="text-sm">Cargando Archivos Porfavor Espere.....</span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="submitButtonEvidencias"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            @foreach (range(1, 6) as $i)
                @if ($reporte->{'foto' . $i})
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="/imgverificacion/{{ $reporte->{'foto' . $i} }}"
                            class="withDescriptionGlightbox glightbox-content"
                            data-glightbox="title: Contrato y medidor; description: Contrato #:{{ $reporte->contrato }} - Medidor #:{{ $reporte->medidor }};">
                            <img src="/imgverificacion/{{ $reporte->{'foto' . $i} }}" alt="image" class="img-fluid"
                                style="width:350px; height:250px; object-fit: cover;" />
                        </a>
                    </div>
                @endif
            @endforeach
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 me-auto">
                @if ($reporte->video)
                    <a href="{{ asset('video/' . $reporte['video']) }}"
                        class="withDescriptionGlightbox glightbox-content">
                        <img src="{{ asset('src/image/video.jpeg') }}" alt="image" class="img-fluid"
                            style="width:350px; height:250px; object-fit: cover;" />
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        for (let i = 1; i <= 6; i++) {
            document.getElementById("foto" + i).addEventListener("change", function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('fotoPreview' + i).src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#evidencias').submit(function() {
                $('#submitButtonEvidencias').addClass('d-none');
                $('#progressBarEvidencias').removeClass('d-none');
            });
        });
    </script>
@endsection
