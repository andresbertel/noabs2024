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
    $respuestasNino = $this->procesarRespuestas($idInst);

    $output = "\xEF\xBB\xBF"; // Agregar BOM para UTF-8
    $output .= '
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Sexo</th>
                <th>Fecha Nacimiento</th>
                <th>Edad Actual</th>
                <th>Edad al realizar test</th>
                <th>Curso</th>
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Institucion</th>
                <th>R1</th>
                <th>R2</th>
                <th>R3</th>
                <th>R4</th>
                <th>R5</th>
                <th>R6</th>
                <th>R7</th>
                <th>R8</th>
                <th>R9</th>
                <th>R10</th>
                <th>R11</th>
                <th>R12</th>
                <th>R13</th>
                <th>R14</th>
                <th>R15</th>
                <th>No</th>
                <th>No sé</th>
                <th>Si</th>
                <th>Nivel de riesgo</th>
                <th>Riesgo Familiar</th>
                <th>Riesgo Escolar</th>
                <th>Riesgo Social</th>
                <th>Riesgo Tecnológico</th>
                <th>Fecha realización test</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($respuestasNino as $respuesta) {
        $nino = $respuesta->nino;
        $usuario = $nino->usuario;

        $output .= '
            <tr>
                <td>' . htmlspecialchars($usuario->nombres, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($usuario->apellidos, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->sexo, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->fecha_nacimiento, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars(\Carbon\Carbon::parse($nino->fecha_nacimiento)->age, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars(\Carbon\Carbon::parse($nino->fecha_nacimiento)->diffInYears(\Carbon\Carbon::parse($respuesta->fecha_realizacion)), ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->curso ?? '-', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->departamento, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->direccion, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($nino->institucion->nombre, ENT_QUOTES, 'UTF-8') . '</td>';

        for ($i = 1; $i <= 15; $i++) {
            $output .= '<td>' . htmlspecialchars($respuesta->{'r' . $i}, ENT_QUOTES, 'UTF-8') . '</td>';
        }

        $output .= '
                <td>' . htmlspecialchars($respuesta->negativas, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->neutras, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->acertadas, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->riesgo, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->cFamiliar, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->cEscolar, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->cSocial, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->cTecnologico, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($respuesta->fecha_realizacion, ENT_QUOTES, 'UTF-8') . '</td>
            </tr>';
    }

    $output .= '</tbody></table>';

    $fechaHora = \Carbon\Carbon::now()->format('YmdHis');  // Formato: 2024-12-21-14-30-00


    return response($output, 200)
        ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
        ->header('Content-Disposition', 'attachment; filename="Informe-' . $fechaHora . '.xls"')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
        ->header('Pragma', 'no-cache');
}

public function exportarCSV($idInst = 0)
{
    $respuestasNino = $this->procesarRespuestas($idInst);

    // Agregar BOM para UTF-8
    $output = "\xEF\xBB\xBF";

    // Encabezados de las columnas
    $output .= "Nombre,Apellidos,Sexo,Fecha Nacimiento,Edad Actual,Edad al realizar test,Curso,Departamento,Dirección,Institucion,R1,R2,R3,R4,R5,R6,R7,R8,R9,R10,R11,R12,R13,R14,R15,No,No sé,Si,Nivel de riesgo,Riesgo Familiar,Riesgo Escolar,Riesgo Social,Riesgo Tecnológico,Fecha realización test\n";

    foreach ($respuestasNino as $respuesta) {
        $nino = $respuesta->nino;
        $usuario = $nino->usuario;

        // Asegurarse de que cada campo sea escapado para CSV
        $output .= '"' . str_replace('"', '""', $usuario->nombres) . '",';
        $output .= '"' . str_replace('"', '""', $usuario->apellidos) . '",';
        $output .= '"' . str_replace('"', '""', $nino->sexo) . '",';
        $output .= '"' . str_replace('"', '""', $nino->fecha_nacimiento) . '",';
        $output .= '"' . str_replace('"', '""', \Carbon\Carbon::parse($nino->fecha_nacimiento)->age) . '",';
        $output .= '"' . str_replace('"', '""', \Carbon\Carbon::parse($nino->fecha_nacimiento)->diffInYears(\Carbon\Carbon::parse($respuesta->fecha_realizacion))) . '",';
        $output .= '"' . str_replace('"', '""', $nino->curso ?? '-') . '",';
        $output .= '"' . str_replace('"', '""', $nino->departamento) . '",';
        $output .= '"' . str_replace('"', '""', $nino->direccion) . '",';
        $output .= '"' . str_replace('"', '""', $nino->institucion->nombre) . '",';

        // Añadir respuestas R1-R15
        for ($i = 1; $i <= 15; $i++) {
            $output .= '"' . str_replace('"', '""', $respuesta->{'r' . $i}) . '",';
        }

        // Añadir demás campos
        $output .= '"' . str_replace('"', '""', $respuesta->negativas) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->neutras) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->acertadas) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->riesgo) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->cFamiliar) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->cEscolar) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->cSocial) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->cTecnologico) . '",';
        $output .= '"' . str_replace('"', '""', $respuesta->fecha_realizacion) . '"';
        $output .= "\n";
    }

    $fechaHora = \Carbon\Carbon::now()->format('YmdHis');  // Formato: 2024-12-21-14-30-00


    return response($output, 200)
        ->header('Content-Type', 'text/csv; charset=UTF-8')
        ->header('Content-Disposition', 'attachment; filename="Informe-' . $fechaHora . '.csv"')
        ->header('Cache-Control', 'no-cache')
        ->header('Pragma', 'no-cache');
}


public function procesarRespuestas($idInst = 0)
{
    $respuestasNino = [];
    $user = Auth::user();

    // Obtener respuestas de los niños según el tipo de usuario
    if (isset($user->admin->first()->exists)) {
        $institucion_id = $idInst;
        $ninosConRespuestas = Nino::where('institucion_id', $institucion_id)
            ->whereHas('respuestas')
            ->with('respuestas')
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

    // Procesar respuestas y calcular valores adicionales
    foreach ($respuestasNino as $respuesta) {
        $rp = 0;
        $rneu = 0;
        $rn = 0;

        $rcfamiliar = 0;
        $rctecnologico = 0;
        $rcescolar = 0;
        $rcsocial = 0;
        $totalP = 15;
        $riesgo = "";

        $riesgoFamiliar = "";
        $riesgoSocial = "";
        $riesgoEscolar = "";
        $riesgoTecnologico = "";

        $preguntasTess = pregunta::all();

        // Contar respuestas y calcular riesgos por contexto
        for ($x = 1; $x <= $totalP; $x++) {
            $atr = 'r' . $x;

            // Si la respuesta es "Sí" (1)
            if ($respuesta->$atr === 1) {
                $rp++;
                // Incrementar el contexto correspondiente
                if ($preguntasTess[($x - 1)]->contexto === 'Familiar') {
                    $rcfamiliar++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Técnologico') {
                    $rctecnologico++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Social') {
                    $rcsocial++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Escolar') {
                    $rcescolar++;
                }
            }

            // Si la respuesta es "No sé" (2)
            if ($respuesta->$atr === 2) {
                $rneu++;
                // Incrementar el contexto correspondiente
                if ($preguntasTess[($x - 1)]->contexto === 'Familiar') {
                    $rcfamiliar++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Técnologico') {
                    $rctecnologico++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Social') {
                    $rcsocial++;
                }
                if ($preguntasTess[($x - 1)]->contexto === 'Escolar') {
                    $rcescolar++;
                }
            }

            // Si la respuesta es "No" (3)
            if ($respuesta->$atr === 3) {
                $rn++;
            }
        }

        // Calcular porcentaje de respuestas positivas
        $pocPosi = ($rn * 100) / $totalP;

        // Calcular nivel de riesgo general
        if ($pocPosi >= 0 && $pocPosi <= 37.5) {
            $riesgo = "Alto";
        }

        if ($pocPosi > 37.5 && $pocPosi <= 75) {
            $riesgo = "Medio";
        }

        if ($pocPosi > 75 && $pocPosi <= 100) {
            $riesgo = "Bajo";
        }

        // Calcular riesgo familiar
        if ((($rcfamiliar * 100) / 3) < 50) {
            $riesgoFamiliar = 'Bajo';
        }

        if ((($rcfamiliar * 100) / 3) == 50) {
            $riesgoFamiliar = 'Medio';
        }

        if ((($rcfamiliar * 100) / 3) > 50) {
            $riesgoFamiliar = 'Alto';
        }

        // Calcular riesgo escolar
        if ((($rcescolar * 100) / 3) < 50) {
            $riesgoEscolar = 'Bajo';
        }

        if ((($rcescolar * 100) / 3) == 50) {
            $riesgoEscolar = 'Medio';
        }

        if ((($rcescolar * 100) / 3) > 50) {
            $riesgoEscolar = 'Alto';
        }

        // Calcular riesgo tecnológico
        if ((($rctecnologico * 100) / 6) < 50) {
            $riesgoTecnologico = 'Bajo';
        }

        if ((($rctecnologico * 100) / 6) == 50) {
            $riesgoTecnologico = 'Medio';
        }

        if ((($rctecnologico * 100) / 6) > 50) {
            $riesgoTecnologico = 'Alto';
        }

        // Calcular riesgo social
        if ((($rcsocial * 100) / 3) < 50) {
            $riesgoSocial = 'Bajo';
        }

        if ((($rcsocial * 100) / 3) == 50) {
            $riesgoSocial = 'Medio';
        }

        if ((($rcsocial * 100) / 3) > 50) {
            $riesgoSocial = 'Alto';
        }

        // Asignar valores calculados a las respuestas
        $respuesta->riesgo = $riesgo;
        $respuesta->acertadas = $rn;
        $respuesta->neutras = $rneu;
        $respuesta->negativas = $rp;

        // Asignar los riesgos contextuales
        $respuesta->cFamiliar = $riesgoFamiliar;
        $respuesta->cEscolar = $riesgoEscolar;
        $respuesta->cSocial = $riesgoSocial;
        $respuesta->cTecnologico = $riesgoTecnologico;
    }

    return $respuestasNino;
}




}
