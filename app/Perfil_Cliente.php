<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil_Cliente extends Model
{

    protected $fillable = ['reputacion_cliente','tipo_cliente','estado_cliente','ventas_concretadas'];


    public function User()
    {
    	return $this->belongsTo('App\User');
    }

    protected $primaryKey="user_id";
    public function reputacion($creador,$suma,$contador)
    {
    $cli=Perfil_Cliente::find($creador);
    $cli->Reputacion_Cliente=($suma/$contador);
    $cli->save();
    }

    
}
