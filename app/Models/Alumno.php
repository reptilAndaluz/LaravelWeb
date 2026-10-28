<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumno extends Model
{
    // Esto es el modelo que corresponde a la migración de Alumno
    // El modelo del orm de laravel es eloquent

    protected $table = 'alumno';
    
    // CORREGIDO: Cambiado $filltable por $fillable y 'apellido' por 'apellidos'
    protected $fillable = ['nombre', 'apellidos', 'fnac', 'genero', 'nacceso'];

    public function matriculas(): HasMany {
        return $this->hasMany(Matricula::class);
    }
}