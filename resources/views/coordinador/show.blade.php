@extends('dashboard.dashboard')

@section('content')
    <section style="background-color: #eee;">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        @if ($reporte->estado == 6)
                        <div class="card-header">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Revisado</h4>
                                <p>Este reporte ha sido revisado por el coordinador</p>
                                <a href="{{route('coordinador.index')}}" class="btn btn-outline-success ">Regresar</a>
                            </div>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex flex-start align-items-center">
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">
                                        Numero de Contraro: {{ $reporte->contrato }}
                                    </h6>
                                    <p class="text-muted small mb-0">
                                        Fecha de Lectura - {{ $reporte->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>

                            <p class="mt-3 mb-2 pb-2">
                                <span class="fw-bold">Lectura:</span> {{ $reporte->lectura }}

                                <span class="fw-bold">Numero de Medidor:</span> {{ $reporte->medidor }}
                            </p>
                            <p class="mb-2 pb-2">
                                <span class="fw-bold">Direccion:</span> {{ $reporte->direccion }}
                            </p>
                            <p class="mb-2 pb-2">
                                <span class="fw-bold">Anomalia:</span> {{ $reporte->AnomaliaReporte->nombre }}
                                <span class="fw-bold">imposibilidad:</span> {{ $reporte->imposibilidadReporte->nombre }}
                            </p>
                            <p class="mb-2 pb-2">
                                <span class="fw-bold">Tipo de Comercio:</span> {{ $reporte->ComercioReporte->nombre }}
                            </p>
                            <hr>
                            <h5 class="text-center">Evidencias</h5>
                            <hr>

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <!-- Button fotos modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#fotografias">
                                    Fotografias
                                </button>
                                <!-- Modal fotos -->
                                <div class="modal fade " id="fotografias" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fotografias Evidencia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                      <div class="carousel-item active">
                                                        <img  src="/imagen/{{ $reporte->foto1 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Foto de la Vivienda</h5>
                                                        </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="/imagen/{{ $reporte->foto2 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Numero del serial</h5>
                                                        </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="/imagen/{{ $reporte->foto3 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Numero de Lectura</h5>
                                                        </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="/imagen/{{ $reporte->foto4 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Numero del Medidor</h5>
                                                        </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="/imagen/{{ $reporte->foto5 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Estado del Medidor</h5>
                                                        </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="/imagen/{{ $reporte->foto6 }}" class="d-block w-100" alt="...">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>Opcional</h5>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Anterior</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Siguiente</span>
                                                    </button>
                                                  </div>
                                                </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button video modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#video">
                                    Video
                                </button>
                                <!-- Modal video -->
                                <div class="modal fade" id="video" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Video Anomalia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <video width="100%" height="100%" controls>
                                                        <source src="{{ asset('video/' . $reporte['video']) }}" type="video/mp4">
                                                        Tu navegador no soporta el elemento de video.
                                                    </video>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($reporte->estado != 6)
                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <form action="{{ route('coordinador.update', $reporte->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="observaciones"></textarea>
                                        <label class="form-label" for="textAreaExample">Observaciones</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="flexRadioDefault1" value="6">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Revisado
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="flexRadioDefault2" value="7">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Rechazado
                                            </label>
                                        </div>
                                        <div class="float-end mt-2 pt-1">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Enviar
                                            </button>
                                            <a type="button" href="{{ route('coordinador.index') }}"
                                                class="btn btn-outline-primary btn-sm">
                                                Cancel
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection
@section('js')
@endsection
