<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{

    protected $fillable = ['tipo_pago','banco','tipo_cuenta','cantidad_cuota'];

    public function Servicio()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function cuotas()
    {
        $cuotas = [];
        for($i=1; $i<=$this->cantidad_cuota; $i++){
            $cuotas[] = $i;
        }
        return $this->cuotas = $cuotas;
    }
} 
