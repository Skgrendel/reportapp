@extends('layouts.frontpage.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @livewire('auditoria-datatable')
        </div>
    </div>
@endsection
@section('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
