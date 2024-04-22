<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nino extends Model
{
    protected $fillable = [
        'id','user_id','sexo','curso', 'institucion_id','fecha_nacimiento', 'departamento', 'direccion','activo',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\institucion','institucion_id');
    }

    public function respuestas(){
        return $this->hasMany('App\respuesta_nino','nino_id');
    }
}
