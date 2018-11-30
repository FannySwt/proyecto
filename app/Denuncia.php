<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{

    protected $fillable = ['comentario'];


    public function Servicio()
    {
    	return $this->belongsTo('App\Servicio');
    }
}
