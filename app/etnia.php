<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class etnia extends Model
{
	protected $fillable = ['etnia_nombre', 'estado'];
	protected $primaryKey = 'id_etnia';
    protected $table = 'etnia';
    public $timestamps = false;
}