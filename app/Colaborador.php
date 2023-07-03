<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = [
        'nombre','apellidos','ci','sexo','direccion','municipio','centro','especialidad',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
