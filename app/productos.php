<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{

    protected $fillable = [
        'referencia', 'descripcion', 'valor_unitario'
    ];

    public $timestamps = false;
}
