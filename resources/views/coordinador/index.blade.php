@extends('layouts.frontpage.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @livewire('reportes-datatable')
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
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

@endsection
