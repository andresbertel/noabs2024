<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gestor extends Model
{

    protected $fillable=[
        'user_id','institucion_id','activo',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function institucion()
    {
        return $this->belongsTo(institucion::class);
    }
}
