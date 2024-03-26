<div class="px-5 py-4 ">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        @foreach (range(1, 6) as $i)
            @if ($reporte->{'foto' . $i})
                <div class="relative">
                    <img alt="gallery" class="col-lg-3 col-md-4 col-6" src="/imagen/{{ $reporte->{'foto' . $i} }}" />
                    <div class="position-absolute top-0 start-0 bg-dark text-white p-2" style="background-color: rgba(0,0,0,0.5) !important;">
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
    <div class="w-full">
        <video width="50%" height="50%" controls>
            <source src="{{ asset('video/' . $reporte['video']) }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>

</div>

@section('css')
<style>
    .modal {
        transition: background-color 0.7s ease;
    }
</style>
@endsection
@section('js')
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
@endsection
