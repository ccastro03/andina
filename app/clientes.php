<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class clientes extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'password', 'nombre', 'telefono', 'email', 'codigo'
    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'clientes';
    public $timestamps = false;
    protected $primaryKey = "codigo";
}
