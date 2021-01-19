<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    protected $fillable = [
        'usuario_id', 'producto_id', 'cantidad_producto', 'compra_fecha', 'compra_estado'
    ];

    protected $table = 'compras';
    public $timestamps = false;
    protected $primaryKey = "id";
}