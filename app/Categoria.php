<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre_categoria','descripcion_categoria','estado_categoria','cantidad_publicaciones','edad_recomendada'];
    
    public function Servicio()
    {
    	return $this->hasMany('App\Servicio');
    }
}
