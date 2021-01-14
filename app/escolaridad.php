<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class escolaridad extends Model
{
	protected $fillable = ['escolaridad_nombre', 'estado'];
	protected $primaryKey = 'id_escolaridad';
    protected $table = 'escolaridad';
    public $timestamps = false;
}