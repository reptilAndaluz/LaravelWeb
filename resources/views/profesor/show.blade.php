@extends('template.base')



@section('content')
<div class="container my-5">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="card text-center text-dark">
                <img src="{{ asset('assets/img/avataaars.svg') }}" class="card-img-top" alt="Juan">
                <div class="card-body">
                    <h5 class="card-title">{{ $profesor->nombre . ' ' . $profesor->apellido }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-center text-dark">
                <div class="card-body">
                    <h4 class="card-title">{{ $profesor->fnac ? Carbon\Carbon::parse($profesor->fnac)->locale('es')->translatedFormat('d/m/Y') : '—' }}</h4>
                    <h4 class="card-title">{{ $profesor->genero }}</h4>
                    <h4 class="card-title">{{ $profesor->asignatura }}</h4>
                    <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection