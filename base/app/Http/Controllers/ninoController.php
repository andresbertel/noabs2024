<?php

namespace App\Http\Controllers;

use App\nino;
use App\respuesta_nino;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ninoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function enviarRespuestas() {

       $nino=Auth::user()->nino;


        if(empty ($nino)){
            $idnino='10';
        }else{
            $idnino=$nino->first()->id;
        }
        $valores =request()->all();


        $date = Carbon::now();

        $date = $date->format('Y-m-d');


        DB::transaction(function () use ($date,$valores,$idnino){
            respuesta_nino::create([
                "nino_id" => $idnino,
                "fecha_realizacion" => $date,
                "r1" => $valores[0],
                "r2" => $valores[1],
                "r3" => $valores[2],
                "r4" => $valores[3],
                "r5" => $valores[4],
                "r6" => $valores[5],
                "r7" => $valores[6],
                "r8" => $valores[7],
                "r9" => $valores[8],
                "r10" => $valores[9],
                "r11" => $valores[10],
                "r12" => $valores[11],
                "r13" => $valores[12],
                "r14" => $valores[13],
                "r15" => $valores[14],
                
            ]);

            $ninoActual = nino::find($idnino);
            $ninoActual->activo = 0;
            $ninoActual->save();

        });
    }
    //
}
