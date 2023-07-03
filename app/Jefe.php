<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jefe extends Model
{
    protected $table = 'jefes';

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
