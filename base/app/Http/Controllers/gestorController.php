<?php

namespace App\Http\Controllers;

use App\gestor;
use App\institucion;
use App\nino;
use App\pregunta;
use App\respuesta_nino;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;



class gestorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function registerNinoForm(){


        $instituciones="";
        $user= Auth::user();


        if(isset($user->admin->first()->exists)){
            $instituciones = institucion::all();
            $permitido = true;
        }

        if(isset($user->gestor->first()->exists)){

            $idGestor = Auth::user()->id;
            $gestor = gestor::where('user_id',$idGestor)->first();


            $idInsti = $gestor->institucion_id;
            $instituciones=institucion::where('id', $idInsti)->get();

            $institucioFechaF = $gestor->institucion->fecha_final ;

            $fec_final = new Carbon($institucioFechaF);
            $fec_actual = new Carbon();

            //dd($fec_final);

            if($fec_final>$fec_actual){
                $permitido = true;
            }else{
                $permitido = false;
            }



        }
        return view('nino.nino',['instituciones'=>$instituciones,'permitido'=>$permitido]);
    }


    function registerNino(){

        $valoresNino =request()->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'sexo'=>'required',
            'username'=>'required',
            'id_institucion'=>'required',
            'fecha_nacimiento'=>'required',
            
            'direccion'=>'required',
           
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',

        ],[
            'nombres.required'=>'Nombre es campo requerido',
           
        ]);

        //dd($valoresNino);

        DB::transaction(function () use ($valoresNino) {


            $user= User::create([
                'nombres'=>$valoresNino['nombres'],
                'apellidos'=>$valoresNino['apellidos'],
                'username'=>$valoresNino['username'],
                'email'=>$valoresNino['email'],
                'password'=>bcrypt($valoresNino['password']),

            ]);


            nino::create([
                'user_id'=>$user->id,
                'sexo'=>$valoresNino['sexo'],
                'institucion_id'=>$valoresNino['id_institucion'],
                'fecha_nacimiento'=>$valoresNino['fecha_nacimiento'],
                'departamento'=>$valoresNino['departamento'],
                'direccion'=>$valoresNino['direccion'],
                'activo'=>'1',
            ]);


        });
        Session::flash('flash_message', 'Niño agregado correctamente');
        return redirect()->route('registarninos');

    }


    function registerNinosCsv(Request $request){
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);
    
        $file = $request->file('csv_file');
    
        // Validar el archivo CSV
        $validator = Validator::make(['csv_file' => $file], [
            'csv_file' => 'required|mimes:csv,txt',
        ]);
    


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
    
        // Leer el contenido del archivo CSV
        $csvData = File::get($file);

        if (!mb_check_encoding($csvData, 'UTF-8')) {
            $csvData = mb_convert_encoding($csvData, 'UTF-8');
        }
        
        $rows = array_map(function($row) {
            return str_getcsv($row, ';', '"', '\\');
        }, explode("\n", $csvData));
    
        // Eliminar la primera fila (encabezados) si es necesario
        $headers = array_shift($rows);
      
        DB::beginTransaction();
    
        try {
            foreach ($rows as $row) {              

              if($row[0]!== null && $row[0]!== '' ){
                $user= User::create([
                    'nombres'=>$row[0],
                    'apellidos'=>$row[1],
                    'username'=>$row[3],
                    'email'=>$row[4],
                    'password'=>bcrypt($row[5]),
    
                ]);
    
    
              $nino =  nino::create([
                    'user_id'=>$user->id,
                    'sexo'=>$row[2],
                    'institucion_id'=>$row[6],
                    'fecha_nacimiento'=>  Carbon::createFromFormat('d/m/Y', $row[7])->format('Y-m-d'),
                    'departamento'=>$row[8],
                    'direccion'=>$row[9],
                    'activo'=>'1',
                ]);
              }
            }

            DB::commit();
          
            
            Session::flash('flash_message', 'Niño agregado correctamente');
            return redirect()->route('registarninos');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('flash_message', 'Error al agregar usuarios: ' . $e->getMessage());
            dd( $e->getMessage());
        }
    
        return redirect()->route('registarninos');
    }





    function verNinos(){
        
        $user= Auth::user();
        $ninos = "";
        if(isset($user->admin->first()->exists)){
            $instituciones = institucion::all();
            $ninos = nino::all();
            $permitido = true;
        }
		
		

        if(isset($user->gestor->first()->exists)){

            $permitido = false;

            $idGestor = Auth::user()->id;
            $gestor = gestor::where('user_id',$idGestor)->first();
            $idInsti = $gestor->institucion_id;
            $instituciones=institucion::where('id', $idInsti)->get();

            $ninos = nino::where('institucion_id','=',$idInsti)->get();

            // dd($instituciones->first()->fecha_final);

            $institucioFechaF = $instituciones->first()->fecha_final;
            //dd($institucioFechaF);

            $fec_final = new Carbon($institucioFechaF);
            $fec_actual = new Carbon();

            //dd($fec_final);

            if($fec_final>$fec_actual){
                $permitido = true;
            }


        }



        // dd($ninos);
  $totalNinos = array();
        foreach ($ninos as $nino){
            $userNino = $nino->usuario;
            $institucioNino = $nino->institucion;

            // dd($institucioNino->fecha_final);




            $nombreI = $institucioNino->nombre;
            //dd($nombreI);

            $nino['nombres_user']= $userNino->nombres;
            $nino['apellidos_user']= $userNino->apellidos;
            $nino['username_user']= $userNino->username;
            $nino['email_user']= $userNino->email;
            $nino['nombre_institucion'] = $nombreI;

          
			    $totalNinos[] = $nino;
		  
		  

        }
		$totalninos =collect($totalNinos);
		//dd($total->count());

        return view('nino.allninos',['ninos'=>$totalninos,'instituciones'=>$instituciones,'permitido'=>$permitido]);

    }


    function actualizarNino(){


        $valoresNino =request()->validate([
            'hid'=>'required',
            'huser_id'=>'required',
            'password'=>'',
            'nombres'=>'required|min:5',
            'apellidos'=>'required',
            'sexo'=>'required',
            'username'=>'required|unique:users,username,'.request()->input('huser_id'),
            'id_institucion'=>'required',
            'fecha_nacimiento'=>'required',
            'departamento'=>'required',
            'direccion'=>'required',
            'activo'=>'required',
            'email'=>'required|unique:users,email,'.request()->input('huser_id'),



        ],[
            'nombres.required'=>'Nombre es campo requerido',
            'nombres.min'=>'El nombre debe contener minimo cinco caracteres'
        ]);

        //dd($valoresNino);

        DB::transaction(function () use ($valoresNino) {

            $user = User::find($valoresNino['huser_id']);
            $user->nombres = $valoresNino['nombres'];
            $user->apellidos = $valoresNino['apellidos'];
            $user->username = $valoresNino['username'];
            $user->email = $valoresNino['email'];
            ($valoresNino['password']) ?$user->password = bcrypt($valoresNino['password']) : '' ;
            $user->save();



            $ninoActual = nino::find($valoresNino['hid']);
            $ninoActual->institucion_id = $valoresNino['id_institucion'];
            $ninoActual->fecha_nacimiento = $valoresNino['fecha_nacimiento'];
            $ninoActual->sexo = $valoresNino['sexo'];
            $ninoActual->departamento = $valoresNino['departamento'];
            $ninoActual->direccion = $valoresNino['direccion'];
            $ninoActual->activo = $valoresNino['activo'];
            $ninoActual->save();

        });

        Session::flash('flash_message', 'Niño actualizado correctamente');

        return redirect()->route('ninos');

    }

    function  verResultados(){

        $user= Auth::user();
        if(isset($user->admin->first()->exists)){
            $respuestasNino = respuesta_nino::all();
        }

        if(isset($user->gestor->first()->exists)){

            $ninos = $user->gestor->first()->institucion->nino;
           
            foreach ($ninos as $nino){
				/*if($nino->respuestas->first()!=null){
					$respuestasNino[] = $nino->respuestas->first();
				}*/
				
				if($nino->respuestas->first()!=null){
					 foreach ( $nino->respuestas as $respnino){
					   $respuestasNino[] = $respnino;
					}
					
					
				}
                
            }

            //dd($respuestasNino);

        }

        $collection=Collection::make(null);
		
        foreach ($respuestasNino as $respuesta){
            //dd($respuesta->nino->usuario);
             //dd($respuesta->nino);




           $nino_respuesta['user']=$respuesta->nino->usuario;
          $nino_respuesta['nino']=$respuesta->nino;
         $nino_respuesta['institucion']=$respuesta->nino->institucion;
            $nino_respuesta['respuesta']=$respuesta;


            $rp = 0;
            $rneu = 0;
            $rn = 0;

            $rcfamiliar = 0;
            $rctecnologico = 0;
            $rcescolar = 0;
            $rcsocial = 0;
            $totalP = 15;
            $riego = "";

            $riesgoFamiliar = "";
            $riesgoSocial = "";
            $riesgoEscolar = "";
            $riesgoTecnologico = "";

            $preguntasTess = pregunta::all();
           //dd($preguntasTess[0]->contexto);

          //  dd($nino_respuesta['respuesta']);

            for($x=1;$x<=$totalP;$x++){
                $atr = 'r'.$x;


                if($nino_respuesta['respuesta']->$atr === 1){
                    $rp = $rp + 1;

                    if($preguntasTess[($x - 1)]->contexto==='Familiar'){
                        $rcfamiliar = $rcfamiliar + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Técnologico'){
                        $rctecnologico = $rctecnologico + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Social'){
                        $rcsocial = $rcsocial + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Escolar'){
                        $rcescolar = $rcescolar + 1;
                    }
                }

                if($nino_respuesta['respuesta']->$atr === 2){
                    $rneu = $rneu + 1;

                    if($preguntasTess[($x - 1)]->contexto==='Familiar'){
                        $rcfamiliar = $rcfamiliar + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Técnologico'){
                        $rctecnologico = $rctecnologico + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Social'){
                        $rcsocial = $rcsocial + 1;
                    }

                    if($preguntasTess[($x - 1)]->contexto==='Escolar'){
                        $rcescolar = $rcescolar + 1;
                    }


                }

                if($nino_respuesta['respuesta']->$atr === 3){
                    $rn = $rn + 1;
                }
            }

            $pocPosi =($rn *100)/$totalP;

            if($pocPosi >= 0 and $pocPosi <= 37.5){
                $riego ="Alto";

            }

            if($pocPosi > 37.5 and $pocPosi <= 75){
                $riego ="Medio";
            }

            if($pocPosi > 75 and $pocPosi <= 100){
                $riego ="Bajo";
            }



            if((($rcfamiliar * 100)/3)<50){
                $riesgoFamiliar = 'Bajo';
            }

            if((($rcfamiliar * 100)/3)==50){
                $riesgoFamiliar = 'Medio';
            }

            if((($rcfamiliar * 100)/3)>50){
                $riesgoFamiliar = 'Alto';
            }


            /*::::::::::::::::::::::::::::::::::::::*/

            if((($rcescolar * 100)/3)<50){
                $riesgoEscolar = 'Bajo';
            }

            if((($rcescolar * 100)/3)==50){
                $riesgoEscolar = 'Medio';
            }

            if((($rcescolar * 100)/3)>50){
                $riesgoEscolar = 'Alto';
            }

            /*::::::::::::::::::::::::::::::::::::::*/

            if((($rctecnologico * 100)/6)<50){
                $riesgoTecnologico = 'Bajo';
            }

            if((($rctecnologico * 100)/6)==50){
                $riesgoTecnologico = 'Medio';
            }

            if((($rctecnologico * 100)/6)>50){
                $riesgoTecnologico = 'Alto';
            }

            /*::::::::::::::::::::::::::::::::::::::*/

            if((($rcsocial * 100)/3)<50){
                $riesgoSocial = 'Bajo';
            }

            if((($rcsocial * 100)/3)==50){
                $riesgoSocial = 'Medio';
            }

            if((($rcsocial * 100)/3)>50){
                $riesgoSocial = 'Alto';
            }

            $nino_respuesta['respuesta']['riesgo'] = $riego;
            $nino_respuesta['respuesta']['acertadas'] = $rn;
            $nino_respuesta['respuesta']['neutras'] = $rneu;
            $nino_respuesta['respuesta']['negativas'] = $rp;



            $nino_respuesta['respuesta']['cFamiliar'] = $riesgoFamiliar;
            $nino_respuesta['respuesta']['cEscolar'] = $riesgoEscolar;
            $nino_respuesta['respuesta']['cSocial'] = $riesgoSocial;
            $nino_respuesta['respuesta']['cTecnologico'] = $riesgoTecnologico;


            $nino_respuesta['respuesta']['totalPreguntas'] = $totalP;



            //dd($nino_respuesta['respuesta']);
            $respuestaGenerales[] = $nino_respuesta;
            $collection = Collection::make($respuestaGenerales);
            //dd($collection->toJson());
            //dd($collection->toJson());
            unset($nino_respuesta);


        }

        //dd($respuestaGenerales);
        //dd($respuestaGenerales);



        return view('nino.respuestas',['respuestaGenerales'=>$collection]);
    }

    function verResultadosById($idRes=0){

        $resultador = respuesta_nino::where('id','=',$idRes)->select('r1','r2','r3','r4','r5','r6','r7','r8','r9','r10','r11','r12','r13','r14','r15')->get();
        $preguntas = pregunta::all();

        if(request()->ajax()){

            return response()->json([
                'resultados'=>  $resultador,
                'preguntas'=> $preguntas,
            ]);


        }

        //return $resultador;

    }

    public function pdf()
    {
        //return view('respuestasPDF');
        $pdf = PDF::loadView('respuestasPDF');

        return $pdf->download('listado.pdf');
    }


}
