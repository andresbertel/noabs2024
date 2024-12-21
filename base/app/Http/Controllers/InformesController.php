<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gestor;
use App\institucion;
use App\nino;
use App\pregunta;
use App\respuesta_nino;
use App\User;
//use App\base\UsersExport;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

//use Barryvdh\DomPDF\Facade as PDF;

use Carbon\Carbon;

use PDF;


//use Maatwebsite\Excel\Facades\Excel;


class InformesController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    function verResultadosById($idRes=0){

        $resultador = respuesta_nino::where('id','=',$idRes)->select('r1','r2','r3','r4','r5','r6','r7','r8','r9','r10','r11','r12','r13','r14','r15')->get();
        $preguntas = pregunta::all();
    
       $user= Auth::user();
       if(isset($user->admin->first()->exists)){
           $respuestasNino = respuesta_nino::where('id','=',$idRes)->get();
       }

       if(isset($user->gestor->first()->exists)){

           $ninos = $user->gestor->first()->institucion->nino;
           
        
          
           foreach ($ninos as $nino){
      
            $respuesta = $nino->respuestas->firstWhere('id', $idRes);

            // Si encontramos la respuesta, la agregamos al array $respuestasNino
            if ($respuesta) {               
                $respuestasNino[] = $respuesta;
                break;
            }
               
           }

         

       }

       $collection=Collection::make(null);
       $nino_respuesta['preguntas']= pregunta::all(); 
      
      
       foreach ($respuestasNino as $respuesta){

     
        
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

           $respuestaGenerales[] = $nino_respuesta;
           $collection = Collection::make($respuestaGenerales);
         
           unset($nino_respuesta);


       }

     
       $modelo = $collection;
       $primerElemento = $modelo->first()['user'];

      if ($primerElemento) {
        $nombre = $primerElemento->nombres;
        $apellido = $primerElemento->apellidos;

       // Ahora puedes concatenar los atributos en una cadena
        $nombreArchivo = $nombre . ' ' . $apellido.'.pdf';

     
      }

    

       $data = ['respuestaGenerales'=>$modelo];

    

       $pdf = app('dompdf.wrapper');
       $pdf->loadView('Informes.test',$data)->setOptions(['defaultFont' => 'DejaVuSans-Bold'])->setPaper('a4', 'landscape');
       
      //return view('Informes.test',$data);

       return $pdf->download($nombreArchivo);
    }


    function InformePorInstitucion($idInst=0){

        $resultador = respuesta_nino::where('id','=',$idInst)->select('r1','r2','r3','r4','r5','r6','r7','r8','r9','r10','r11','r12','r13','r14','r15')->get();
        $preguntas = pregunta::all();
        
       $user= Auth::user();
       if(isset($user->admin->first()->exists)){
        $institucion_id = $idInst; // ID de la institución que deseas consultar

      
           // $respuestasNino = respuesta_nino::where('id','=',$idRes)->get();
           $ninosConRespuestas = Nino::where('institucion_id', $institucion_id)
           ->whereHas('respuestas') // Filtrar solo los niños que tienen respuestas asociadas
           ->with('respuestas') // Cargar las respuestas asociadas
           ->get();

           $respuestasNino = [];

           foreach ($ninosConRespuestas as $nino) {
               if ($nino->respuestas->isNotEmpty()) {
                   foreach ($nino->respuestas as $respnino) {
                       $respuestasNino[] = $respnino;
                   }
               }
           }
 
        
       }

       if(isset($user->gestor->first()->exists)){

           $ninos = $user->gestor->first()->institucion->nino;
          
           foreach ($ninos as $nino){
          
               if($nino->respuestas->first()!=null){
                    foreach ( $nino->respuestas as $respnino){
                      $respuestasNino[] = $respnino;
                   }
                   
                   
               }
               
           }

         

       }

       $collection=Collection::make(null);
       $nino_respuesta['preguntas']= pregunta::all(); 
      

       foreach ($respuestasNino as $respuesta){
 
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
           $nino_respuesta['today'] = Carbon::now();
           
           $respuestaGenerales[] = $nino_respuesta;
          
       
           $collection = Collection::make($respuestaGenerales);

          
         
           unset($nino_respuesta);


       }

     
       $modelo = $collection;

  

       $data = ['respuestaGenerales'=>$modelo];

         
       // init_set('memory_limit','-1');
       // set_time_limit(3000000);

      // $pdf = app('dompdf.wrapper');
      // $pdf->loadView('Informes.ResultadoestudianteInstitucion',$data)->setOptions(['defaultFont' => 'DejaVuSans-Bold'])->setPaper('a4', 'landscape');

     return view('Informes.ResultadoestudianteInstitucion',$data);

       //return $pdf->download($nombreArchivo);
    }

    public function InformesView() 
    {    
        $user= Auth::user();
        
        if(isset($user->admin->first()->exists)){
            $instituciones = institucion::all();
          
        }
		
		

        if(isset($user->gestor->first()->exists)){         

            $idGestor = Auth::user()->id;
            $gestor = gestor::where('user_id',$idGestor)->first();
            $idInsti = $gestor->institucion_id;
            $instituciones=institucion::where('id', $idInsti)->get();
        }


         

        return view('Informes.GenerarInformeView',['instituciones' => $instituciones]);
    }

    public function generarInforme(Request $request)
    {
        // Obtener el ID de la institución seleccionada desde el formulario
        $idInstitucion = $request->input('institucion');

        // Redirigir a la ruta 'informesInstitucion' pasando el ID de la institución como parámetro
        return redirect()->route('inforinst', ['idInst' => $idInstitucion]);
    }

  public function descargarcsv()
    {
       $csvFilePath = public_path('ejemplo-carga-masiva.csv'); // Ruta al archivo CSV en la carpeta public
        return Response::download($csvFilePath);
    }

    public function exportarExcel($idInst = 0)
    {
        $fileName = 'respuestas.csv'; // Nombre del archivo
        $respuestasNino = []; // Inicializar array para almacenar las respuestas
        $user = Auth::user();
    
        // Obtener respuestas de los niños según el tipo de usuario
        if (isset($user->admin->first()->exists)) {
            $institucion_id = $idInst;
            $ninosConRespuestas = Nino::where('institucion_id', $institucion_id)
                ->whereHas('respuestas') // Filtrar niños con respuestas asociadas
                ->with('respuestas') // Cargar respuestas asociadas
                ->get();
    
            foreach ($ninosConRespuestas as $nino) {
                if ($nino->respuestas->isNotEmpty()) {
                    foreach ($nino->respuestas as $respnino) {
                        $respuestasNino[] = $respnino;
                    }
                }
            }
        }
    
        if (isset($user->gestor->first()->exists)) {
            $ninos = $user->gestor->first()->institucion->nino;
    
            foreach ($ninos as $nino) {
                if ($nino->respuestas->first() != null) {
                    foreach ($nino->respuestas as $respnino) {
                        $respuestasNino[] = $respnino;
                    }
                }
            }
        }
    
        // Verificar que existan respuestas antes de continuar
        if (empty($respuestasNino)) {
            return response()->json(['error' => 'No se encontraron datos para exportar'], 404);
        }
    
        // Crear los encabezados del archivo CSV
        $headers = [
            "Nombre", "Apellidos", "Sexo", "Fecha Nacimiento", "Edad Actual", "Edad al realizar test",
            "Curso", "Departamento", "Dirección", "Institución", "R1", "R2", "R3", "R4", "R5", "Fecha realización test"
        ];
    
        // Crear un buffer en memoria para almacenar el contenido del CSV
        $csvContent = fopen('php://temp', 'w+');
    
        // Agregar BOM UTF-8 al inicio del archivo
        fwrite($csvContent, "\xEF\xBB\xBF");
    
        // Escribir los encabezados
        fputcsv($csvContent, $headers);
    
        // Procesar las respuestas y escribir cada fila en el CSV
        foreach ($respuestasNino as $respuesta) {
            $nino = $respuesta->nino;
            $usuario = $nino->usuario;
    
            $fechaNacimiento = \Carbon\Carbon::parse($nino->fecha_nacimiento);
            $edadActual = $fechaNacimiento->age;
            $edadAlTest = $fechaNacimiento->diffInYears(\Carbon\Carbon::parse($respuesta->fecha_realizacion));
    
            $row = [
                $usuario->nombres,
                $usuario->apellidos,
                $nino->sexo,
                $nino->fecha_nacimiento,
                $edadActual,
                $edadAlTest,
                $nino->curso ?? '-',
                $nino->departamento,
                $nino->direccion,
                $nino->institucion->nombre,
                $respuesta->r1,
                $respuesta->r2,
                $respuesta->r3,
                $respuesta->r4,
                $respuesta->r5,
                $respuesta->fecha_realizacion,
            ];
    
            fputcsv($csvContent, $row);
        }
    
        // Rebobinar el buffer para preparar la descarga
        rewind($csvContent);
    
        // Configurar encabezados para la descarga del archivo CSV
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'no-cache',
        ];
    
        // Enviar el contenido del CSV al navegador
        return response()->stream(function () use ($csvContent) {
            fpassthru($csvContent);
        }, 200, $headers);
    }
    
    
    


}
