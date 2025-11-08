<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //He creado este modelo para poder acceder desde cualquier lado a los datos de alumno
    protected $table = 'alumnos';

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'fecha_nacimiento',
        'nota_media',
        'experiencia',
        'formacion',
        'habilidades',
        'fotografia',
        'pdf_cv'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'nota_media' => 'decimal:2'
    ];
}
