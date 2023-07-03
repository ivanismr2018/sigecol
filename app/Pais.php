<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
