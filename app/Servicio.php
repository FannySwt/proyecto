<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{

    protected $fillable = ['nombre_servicio','descripcion_servicio','estado','fecha_publicacion_se','fecha_finalizacion_se','precio_servicio','tags_servicio','tipo_pago','visitas','creador','ubicacion','me_gusta','no_me_gusta','categoria_id','denunciado'];

    public function image()
    {
    	return $this->hasMany('App\image');
    }

    public function Ubicacion()
    {
    	return $this->belongsToMany('App\Ubicacion');
    }

    public function Denuncia()
    {
    	return $this->hasMany('App\Denuncia');
    }

    public function encuesta()
    {
    	return $this->hasMany('App\encuesta');
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
    
    public function usuariosContratando()
    {
        return $this->belongsToMany('App\User')->withPivot(
            'fecha_contratacion',
            'fecha_fin_contratacion',
            'descuento_tipo_cliente',
            'tipo_pago',
            'numero_tarjeta',
            'numero_cuota',
            'valor_cuota',
            'me_gusta',
            'evaluar',
            'denunciar');
    }

}
