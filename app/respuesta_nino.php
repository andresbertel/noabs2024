<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class respuesta_nino extends Model
{

    //protected $table='respuesta_ninos';


    protected $fillable=[
        'nino_id','fecha_realizacion','r1','r2','r3','r4','r5','r6','r7','r8','r9','r10','r11','r12','r13','r14','r15'
         ];

   public function nino(){
        return $this->belongsTo('App\nino');
    }
}
