<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{

    protected $fillable=[
        'id','nombre','departamento','direccion','telefono','fecha_inicio','fecha_final','numero_test'
    ];

    public function gestor()
    {
        return $this->hasMany('App\gestor','institucion_id');
    }

    public function nino()
    {
        return $this->hasMany('App\nino','institucion_id');
    }


    //
}
