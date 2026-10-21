@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update' , $profesor) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" value="{{ old('nombre' , $profesor->nombre) }}" class="form-control" id="nombre" name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                     @error('nombre')
                     <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                      {{ $message }}
                    </div>
                    @enderror()
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" value="{{ old('apellido', $profesor->apellido) }}" class="form-control" id="apellido" name="apellido" required maxlength="130" placeholder="Introduce el apellido del profesor">
                    @error('apellido')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;" >
                    {{ $message }}
                    </div>
                    @enderror()
                </div>
                <div class="mb-3">
                    <label for="asignatura" class="form-label">Asignatura</label>
                    <input type="text" value="{{ old('asignatura', $profesor->asignatura) }}" class="form-control" id="asignatura" name="asignatura" required maxlength="130" placeholder="Introduce la asignatura del profesor">
                    @error('asignatura')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;" >
                    {{ $message }}
                    </div>
                    @enderror()
                </div>
                <div class="mb-3">
                    <label for="fnac" class="form-label">Fecha de nacimiento</label>
                    <input type="date" value="{{ old('fnac', $profesor->fnac) }}" class="form-control" id="fnac" name="fnac">
                     @error('fnac')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;" >
                    {{ $message }}
                    </div>
                    @enderror()
                </div>
                <div class="mb-3">
                  <label for="genero" class="form-label">Género</label>
                  <select class="form-select" id="genero" name="genero">
                  <option value="" @selected(old('genero', $profesor->genero) == '')>Selecciona una opción</option>
                  <option value="masculino" @selected(old('genero', $profesor->genero) == 'masculino')>Masculino</option>
                  <option value="femenino" @selected(old('genero', $profesor->genero) == 'femenino')>Femenino</option>
                  <option value="otro" @selected(old('genero', $profesor->genero) == 'otro')>Otro</option>
                  </select>
                   @error('genero')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                    {{ $message }}
                    </div>
                    @enderror()
                 </div>
                
                <button type="submit" class="btn btn-secondary">
                    Editar profesor
                </button>
            </form>
        </div>
    </div>
</div>
@endsection