<?php

namespace App\Http\Controllers;

use App\gestor;
use App\institucion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function andresMetodo(){
        return 'andres';
     }

    function institucionForm(){
        return view('institucion.institucion');
    }

    function registerIntitucion (){

        $fec_actual = new Carbon();

        $valoresInstitucion =request()->validate([
            'nombre'=>'required|min:5',
            'departamento'=>'required',
            'direccion'=>'required',
            'departamento'=>'required',
            'telefono'=>'required|numeric',
            'fecha_inicio'=>'',
            'fecha_final'=>'required',
        ],[
            'nombre.required'=>'Nombre es campo requerido',
            'nombre.min'=>'El nombre debe contener minimo cinco caracteres'
        ]);

        //dd($valoresInstitucion);

        Institucion::create([
            'nombre'        =>  $valoresInstitucion['nombre'],
            'departamento'  =>  $valoresInstitucion['departamento'],
            'direccion'     =>  $valoresInstitucion['direccion'],
            'telefono'      =>  $valoresInstitucion['telefono'],
            'direccion'     =>  $valoresInstitucion['direccion'],
            'fecha_inicio'  =>  $fec_actual,
            'fecha_final'   =>  $valoresInstitucion['fecha_final'],

        ]);


        Session::flash('flash_message', 'Institucion agregada correctamente');
        return redirect()->route('registarinstitucion');

    }

    function gestorForm (){

        $instituciones = institucion::all();
        return view('gestor.gestor',['instituciones'=>$instituciones,]);

    }

    function  registerGestor(){

        $valoresGestor =request()->validate([
            'nombres'=>'required|min:5',
            'apellidos'=>'required',
            'username'=>'required',
            'id_institucion'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',

        ],[
            'nombres.required'=>'Nombre es campo requerido',
            'nombres.min'=>'El nombre debe contener minimo cinco caracteres'
        ]);

        //dd($valoresGestor);

        DB::transaction(function () use ($valoresGestor) {

            $user= User::create([
                'nombres'=>$valoresGestor['nombres'],
                'apellidos'=>$valoresGestor['apellidos'],
                'username'=>$valoresGestor['username'],
                'email'=>$valoresGestor['email'],
                'password'=>bcrypt($valoresGestor['password']),

            ]);

            Gestor::create([
                'user_id'=>$user->id,
                'institucion_id'=>$valoresGestor['id_institucion'],
                'activo'=>'1',
            ]);

        });

        Session::flash('flash_message', 'Gestor agregado correctamente');
        return redirect()->route('registergestor');


    }

    function verGestores(){
        $gestores = gestor::all();
        $instituciones = institucion::all();


        foreach ($gestores as $gestor){

            $gestorActual['id_user']=$gestor->usuario->id;
            $gestorActual['nombres']=$gestor->usuario->nombres;
            $gestorActual['apellidos']=$gestor->usuario->apellidos;
            $gestorActual['username']=$gestor->usuario->username;
            $gestorActual['email']=$gestor->usuario->email;
            $gestorActual['id_gestor']=$gestor->id;
            $gestorActual['id_institucion']=institucion::find($gestor->institucion_id)->id;
            $gestorActual['institucion_nombre']=institucion::find($gestor->institucion_id)->nombre;
            $gestorActual['activo']=$gestor->activo;

            $gestoresTotal[]= $gestorActual;

        }

        return view('gestor.allGestores',['gestores'=>$gestoresTotal,'instituciones'=>$instituciones]);

    }


    function verInstituciones(){
        $instituciones = institucion::all();


         return view('institucion.allInstituciones',['instituciones'=>$instituciones]);

    }

    function actualizarInstitucion(){

        $valoresInstitucion =request()->validate([
            'id'=>'required',
            'nombre'=>'required|min:5',
            'departamento'=>'required',
            'direccion'=>'required',
            'telefono'=>'required|numeric',
            'fecha_inicio'=>'required',
            'fecha_final'=>'required',
        ],[
            'nombre.required'=>'Nombre es campo requerido',
            'nombre.min'=>'El nombre debe contener minimo cinco caracteres'
        ]);

        $institucion = institucion::find($valoresInstitucion['id']);
        $institucion->update($valoresInstitucion);
//        $institucion->nombre=$valoresInstitucion['nombre'];
//        $institucion->departamento=$valoresInstitucion['departamento'];
//        $institucion->direccion=$valoresInstitucion['direccion'];
//        $institucion->telefono=$valoresInstitucion['telefono'];
//        $institucion->fecha_inicio=$valoresInstitucion['fecha_inicio'];
//        $institucion->fecha_final=$valoresInstitucion['fecha_final'];
//        $institucion->save();

        return redirect()->route('instituciones');

    }

    function actualizarGestor(){

        $valoresGestor =request()->validate([
            'id'=>'required',
            'nombres'=>'required|min:5',
            'apellidos'=>'required',
            'username'=>'required',
            'id_institucion'=>'required',
            'email'=>'required',
            'password'=>'',


        ],[
            'nombres.required'=>'Nombre es campo requerido',
            'nombres.min'=>'El nombre debe contener minimo cinco caracteres'
        ]);



        DB::transaction(function () use ($valoresGestor) {

            $user = User::find($valoresGestor['id']);
            $gestor_id = $user->gestor->first()->id;

            $user->nombres = $valoresGestor['nombres'];
            $user->apellidos = $valoresGestor['apellidos'];
            $user->username = $valoresGestor['username'];
            $user->email = $valoresGestor['email'];
            $user->password = bcrypt($valoresGestor['password']);
            $user->save();

           $gestor = gestor::find($gestor_id);
           $gestor->institucion_id = $valoresGestor['id_institucion'];
           $gestor->save();

        });

        return redirect()->route('gestores');

    }


/* function reportepdf()
    {

       // return "Holaaaaa";
       // return view('respuestasPDF');
      /* Session::flash('flash_message', 'Test');
       dd("Holaa");
        $pdf = PDF::loadView('respuestasPDF');

        return $pdf->download('listado.pdf');*/
   // }

    



    //
}
