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
                "r1" => $valores['r1'],
                "r2" => $valores['r2'],
                "r3" => $valores['r3'],
                "r4" => $valores['r4'],
                "r5" => $valores['r5'],
                "r6" => $valores['r6'],
                "r7" => $valores['r7'],
                "r8" => $valores['r8'],
                "r9" => $valores['r9'],
                "r10" => $valores['r10'],
                "r11" => $valores['r11'],
                "r12" => $valores['r12'],
                "r13" => $valores['r13'],
                "r14" => $valores['r14'],
                "r15" => $valores['r15'],
                "r16" => $valores['r16'],
                "r17" => $valores['r17'],
            ]);

            $ninoActual = nino::find($idnino);
            $ninoActual->activo = 0;
            $ninoActual->save();

        });
    }
    //
}
