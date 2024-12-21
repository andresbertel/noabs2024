<?php

namespace App\Http\Controllers;

use App\institucion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = Auth::user();
        $permitido = true;
       //dd($user->nino->first());
       $ninoA = $user->nino->first();
       if(isset($ninoA)){
           $id_insti = $user->nino->first()->institucion_id;
           $institucionNino = institucion::find($id_insti);

           $institucioFechaF = $institucionNino->fecha_final ;

           $fec_final = new Carbon($institucioFechaF);
           $fec_actual = new Carbon();

          
           $numero_ninos_con_respuestas = $user->nino()->whereHas('respuestas')->count();
          // dd($numero_ninos_con_respuestas);

           if($fec_final>$fec_actual){
               $permitido = true;
           }else{
               $permitido = false;
           }
       }



        return view('home',['permitido'=>$permitido]);
    }
}
