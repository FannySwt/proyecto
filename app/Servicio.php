<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{

    protected $fillable = ['nombre_servicio','descripcion_servicio','estado','fecha_publicacion_se','fecha_finalizacion_se','precio_servicio','tags_servicio','tipo_pago','visitas','creador','ubicacion','reputacion','categoria_id'];

    public function image()
    {
    	return $this->hasMany('App\image');
    }

    public function Ubicacion()
    {
    	return $this->belongsToMany('App\Ubicacion');
    }

    public function encuesta()
    {
    	return $this->hasMany('App\encuesta');
    }

    public function reclamo()
    {
        return $this->hasMany('App\reclamo');
    }

    public function Categoria()
    {
    	return $this->belongsTo('App\Categoria');
    }

    //Un servicio es creado por un usuario
    public function Creador()
    {
        return $this->belongsTo('App\User');
    }

    //Un servicio es creado por muchos usuarios
    public function User()
    {
    	return $this->belongsToMany('App\User');
    }

    public function MetodoPago()
    {
    	return $this->belongsToMany('App\MetodoPago');
    }


    public function aumenta($id)
    {
        $se=servicio::find($id);
        $se->Visitas=($se->Visitas+1);
        $se->save();
    }
}
