<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil_Secretaria extends Model
{

    protected $fillable = ['fecha_contratacion'];
    public function User()
    {
    	return $this->belongTo('App\User');
    }
}
