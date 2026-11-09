@extends('template.base')

@section('content')

<h1>Matricular</h1>
<h2>{{ $modulo->nombre }} ({{ $modulo->abreviatura }})</h2>
<h4>Curso escolar: {{ $curso_escolar ?? 'sin definir' }}</h4>
<hr>
<!--Mr.Blond & me-->
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="{{ route('matricula.storealumnos') }}" method="post">
                @csrf 
                <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Fecha Nacimiento</th>
                            <th>Género</th>
                            <th>Nota Acceso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td><input class="form-check-input"
                                    type="checkbox"
                                    value="{{ $alumno->id }}"
                                    name="alumnos[]"
                                    @if(in_array($alumno->id, $matriculadosIds ?? [])) checked @endif>
                                </td>
                                <td>{{ $alumno->nombre }}</td>
                                <td>{{ $alumno->apellidos }}</td>
                                <td>{{ $alumno->fnac ? \Carbon\Carbon::parse($alumno->fnac)->locale('es')->translatedFormat('d/m/Y') : '-' }}</td>
                                <td>{{ ucfirst($alumno->genero ?? '-') }}</td>
                                <td>{{ $alumno->nacceso ?? '-' }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-start">
                                <a href="{{ route('modulo.index') }}" class="btn btn-secondary">Volver</a>
                            </td>
                            <td colspan="2" class="text-end">
                                <button class="btn btn-secondary" type="submit">Matricular</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection