@extends('template.base')

@section('css')
<link href="{{ asset('assets/style/show.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <h1>Alumnos</h1>
    <a href="{{ route('alumno.create') }}" class="btn btn-secondary mb-3">Crear Alumno</a>
    <a href="{{ route('modulo.create') }}" class="btn btn-secondary mb-3">Crear Módulo</a>
    <a href="{{ route('alumno.index') }}" class="btn btn-secondary mb-3">Ver Alumnos</a>
    <a href="{{ route('modulo.index') }}" class="btn btn-secondary mb-3">Ver Módulos</a>
    <hr>
</div>
<div class="container my-5">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="card text-center">
                <img src="{{ asset('assets/img/alumno.jpg') }}" class="card-img-top" alt="Alumn@">
                <div class="card-body">
                    <h5 class="card-title">{{ $alumno->nombre . ' ' . $alumno->apellidos }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">{{ Carbon\Carbon::parse($alumno->fnac)->locale('es')->translatedFormat('j \d\e F \d\e Y') }}</h4>
                    <h4 class="card-title">{{ $alumno->genero }}</h4>
                    <h4 class="card-title">{{ $alumno->nacceso }}</h4>
                    <a href="{{ route('alumno.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection