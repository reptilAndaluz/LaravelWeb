<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    // Esto es el modelo que corresponde a la migración de Alumno
    // El modelo del orm de laravel es eloquent

    protected $table = 'alumno';
    
    protected $filltable = ['nombre','apellido','fnac','genero','nacceso'];

}
