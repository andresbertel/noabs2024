<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pregunta extends Model
{
    protected $fillable = [
        'pregunta', 'contexto',
    ];
}
