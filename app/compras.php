<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use Notifiable;

    protected $fillable = [
        'compra_id', 'usuario_id', 'producto_id', 'compra_fecha', 'compra_estado'
    ];

    protected $table = 'compras';
    public $timestamps = false;
    protected $primaryKey = "compra_id";
}