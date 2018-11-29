<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rut_usuario','nombre_usuario', 'email','password' ,'alias','fecha_nac','domicilio_usuario','telefono','tipo_usuario'];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password_Usuario', 'remember_token',
    ];


    public function Perfil_Cliente()
    {
        return $this->hasOne('App\Perfil_Cliente');
    }

    public function Perfil_Secretaria()
    {
        return $this->hasOne('App\Perfil_Secretaria');
    }
    //un usuario tiene muchos servicios
    public function Servicios()
    {
        return $this->hasMany('App\Servicio');
    }

    //Un usuario Contrata muchos servicios
    public function ServiciosContratados()
    {
        return $this->belongsToMany('App\Servicio')->withPivot(
            'fecha_contratacion',
            'fecha_fin_contratacion',
            'descuento_tipo_cliente',
            'tipo_pago',
            'numero_tarjeta',
            'numero_cuota',
            'valor_cuota',
            'me_gusta',
            'evaluar');
    }

}
