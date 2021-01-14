<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'password', 'usuario_nombre', 'usuario_telf', 'email',
    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'usuarios';
    public $timestamps = false;
    protected $primaryKey = "usuario_id";
}
