@extends('template.base')

@section('content')

<h1>Matricular</h1>
<h1>{{ $alumno->nombre }}</h1>
<hr>
<!--Pilar-->
    <div class="container">

        <div class="row">
            <div class="col-md-6 mx-auto">
                <h2>Curso escolar: {{ $curso_escolar ?? 'sin definir' }}</h2>
                @php
                    $disponibles = array_diff(array_keys($modulos->toArray()), $matriculadosIds ?? []);
                @endphp
                @if(count($disponibles) === 0 && count($modulos) > 0)
                    <div class="alert alert-info mb-3">
                        Este alumno ya está matriculado en todos los módulos disponibles para este curso escolar.
                    </div>
                @endif
                <form action="{{ route('matricula.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">
                    <div class="mb-3">
                        <label for="modulo_id" class="form-label">Módulo en el que se matricula</label>
                        <select name="modulo_id" id="modulo_id" class="form-select" required>
                            <option value="" selected disabled>Selecciona un modulo ...</option>
                            @foreach($modulos as $index => $modulo)
                                @php $yaMatriculado = in_array($index, $matriculadosIds ?? []); @endphp
                                <option value="{{ $index }}" {{ $yaMatriculado ? 'disabled' : '' }}>
                                    {{ $modulo }}{{ $yaMatriculado ? ' (Ya matriculado)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="submit" {{ count($disponibles) === 0 ? 'disabled' : '' }}>Matricular</button>
                    <a href="{{ route('alumno.show', $alumno) }}" class="btn btn-secondary">Volver</a>
                </form>
                @if(isset($matriculasActuales) && $matriculasActuales->count() > 0)
                    <div class="mt-4 text-start">
                        <h5>Módulos matriculados este curso:</h5>
                        <ul class="list-group">
                            @foreach($matriculasActuales as $mat)
                                <li class="list-group-item text-dark">
                                    {{ $mat->modulo->nombre }} ({{ $mat->modulo->abreviatura }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
<hr>
@endsection