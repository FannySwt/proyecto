<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $fillable = ['calle','numero_casa'];

    public function Servicio()
    {
    	return $this->belongsToMany('App\Servicio');
    }
}
