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
                                                    </strong>
                                                </span>
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
                                            {{ $reporte->ComercioReporte && (is_null($reporte->ComercioReporte->nombre) || $reporte->ComercioReporte->nombre == 0) ? 'por revisar' : $reporte->ComercioReporte->nombre ?? 'por revisar' }}
                                        </span>
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
                                        <span class="text-card text-sm">Nombre del Comercio: {{$reporte->nombre_comercio}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @if ($reporte->revisado === 0 || $reporte->revisado === null)
                            <form action="{{ route('auditorias.update', $reporte->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="revisado"
                                        value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Revisado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                        name="confirmado_anomalia" value="1">
                                    <label class="form-check-label" for="inlineCheckbox2">Anomalia Confirmada</label>
                                </div>
                                <div class=" d-flex justify-content-between ">
                                    <a href="{{ route('auditorias.edit', $reporte->id) }}"
                                        class="btn text-success bs-tooltip rounded  me-4" data-bs-placement="top"
                                        title="Descargar Informe">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"
                                            id="Download--Streamline-Blocks---Free" height="16" width="16">
                                            <desc>Download Streamline Icon: https://streamlinehq.com</desc>
                                            <path fill="#0fcceb" d="M11 0H5v4H1l7 7 7 -7h-4V0Z" stroke-width="1"></path>
                                            <path fill="#0fcceb" d="M16 13v3H0v-3h16Z" stroke-width="1"></path>
                                        </svg>
                                    </a>
                                    <button type="submit" id="submitButtonRevisado"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        @endif

                        @if ($reporte->revisado === 1)
                            <div class="alert alert-success" role="alert">
                                <span class="text-sm">Este reporte ya ha sido Auditado</span>
                            </div>
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
                                        <span class="text-card">Comentarios del Agente de Campo</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row">
                            <div class="text-card text-sm">{{ $reporte->comentarios }}</div>
                        </div>

                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @if ($reporte->confirmado_anomalia === 1)
                            <div class="alert alert-success" role="alert">
                                <span class="text-sm">Anomalia Confirmada</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($reporte->revisado === 0 || $reporte->revisado === null ||  Auth::user()->hasRole('Administrador')||  Auth::user()->hasRole('Coordinador'))
        <div class="widget-content widget-content-area mt-2 ">
            <div class="row">
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
                                            <span class="media-title">Auditorias - Revisiones</span>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                            <div class="row">
                                <form action="{{ route('auditorias.update', $reporte->id) }}" method="post"
                                    id="observacion" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group mb-1 ">
                                        <label for="Contrato" class="form-label">Numero de Contrato</label>
                                        <input id="Contrato" class="form-control" name="contrato"
                                            value="{{ $reporte->contrato }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-1 ">
                                                <label for="medidor" class="form-label">Numero de Medidor</label>
                                                <input type="text" class="form-control" id="medidor" name="medidor"
                                                    value="{{ $reporte->medidor }}">
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="exampleFormControlInput1">Numero de Lectura</label>
                                                <input type="text" class="form-control" id="lectura" name="lectura"
                                                    value="{{ $reporte->lectura }}">
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="imposibilidad" class="form-label">Imposibilidad</label>
                                                <select id="imposibilidad" class="form-select" name="imposibilidad">
                                                    <option selected disabled>Seleccione Su imposibilidad</option>
                                                    @foreach ($imposibilidad as $id => $nombre)
                                                        <option value="{{ $id }}"
                                                            {{ $reporte->imposibilidad == $id ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-1 ">
                                                <label for="medidor" class="form-label text-danger ">Medidor
                                                    Anomalia</label>
                                                <input type="text" class="form-control" id="medidor_anomalia"
                                                    name="medidor_anomalia" value="{{ $reporte->medidor_anomalia }}">
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="comercio" class="form-label">Tipo de Comercio</label>
                                                <select id="comercio" class="form-select" name="tipo_comercio">
                                                    <option selected disabled>Seleccione El tipo de Comercio</option>
                                                    @foreach ($comercios as $id => $nombre)
                                                        <option value="{{ $id }}"
                                                            {{ $reporte->tipo_comercio == $id ? 'selected' : '' }}>
                                                            {{ $nombre }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="anomalia" class="form-label">Anomalias Detectadas</label>
                                                <select id="anomalia" class="form-select" name="anomalias[]" multiple
                                                    autocomplete="off" data-placeholder="anomalias">
                                                    @foreach ($anomaliasver as $id => $nombre)
                                                        <option value="{{ $id }}"
                                                            {{ in_array($id, $anomaliasIds) ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                <form action="{{ route('coordinador.store') }}" method="POST"
                                    enctype="multipart/form-data" id="evidencias">
                                    @csrf
                                    <input type="text" name="id" value="{{ $reporte->id }}" hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-4 ">
                                                <input type="file" class="form-control " id="foto1"
                                                    name="foto1" accept="image/jpeg">
                                                <span class="input-group-text" id="foto1">Inmueble</span>
                                            </div>
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" id="foto2" name="foto2"
                                                    accept="image/jpeg">
                                                <span class="input-group-text" for="foto2">Numero Serial</span>
                                            </div>
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" id="foto3" name="foto3"
                                                    accept="image/jpeg">
                                                <span class="input-group-text" for="foto3">Numero Lectura</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" id="foto4" name="foto4"
                                                    accept="image/jpeg">
                                                <span class="input-group-text" for="foto4">Numero Medidor</span>
                                            </div>
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" id="foto5" name="foto5"
                                                    accept="image/jpeg">
                                                <span class="input-group-text" for="foto5">Estado Medidor</span>
                                            </div>
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" id="foto6" name="foto6"
                                                    accept="image/jpeg">
                                                <span class="input-group-text" for="foto6">Opcional</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input class="form-control" type="file" id="video" name="video"
                                                    accept="video/mp4">
                                                <span class="input-group-text" id="video">video</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="alert alert-success d-none alert-evidencia" role="alert"
                                        id="alert">
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
    @endif
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            @foreach (range(1, 6) as $i)
                @if ($reporte->{'foto' . $i})
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="/imagen/{{ $reporte->{'foto' . $i} }}"
                            class="withDescriptionGlightbox glightbox-content"
                            data-glightbox="title: Contrato y medidor; description: Contrato #:{{ $reporte->contrato }} - Medidor #:{{ $reporte->medidor }};">
                            <img src="/imagen/{{ $reporte->{'foto' . $i} }}" alt="image" class="img-fluid"
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
        document.addEventListener("DOMContentLoaded", function(event) {
            new TomSelect("#anomalia", {
                persist: false,
                createOnBlur: true,
            });
        });
    </script>
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
            $('#observacion').submit(function() {
                $('#submitButtonObservacion').addClass('d-none');
                $('#progressBarObservacion').removeClass('d-none');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#evidencias').submit(function(e) {
                e.preventDefault();
                $('#submitButtonEvidencias').addClass('d-none');
                $('#progressBarEvidencias').removeClass('d-none');

                var formData = new FormData($('#evidencias')[0]);

                $.ajax({
                    url: "{{ route('coordinador.store') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#alert').removeClass('d-none');
                        $('.alert-evidencia').text(response.success).show();
                        $('#progressBarEvidencias').addClass('d-none');
                        // $('#evidencias')[0].reset();
                    }
                });
            });
        });
    </script>
@endsection
