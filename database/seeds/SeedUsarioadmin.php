<?php

use App\admin;
use App\gestor;
use App\institucion;
use App\nino;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedUsarioadmin extends Seeder
{
 private $Institucion;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //global $Institucion;



        DB::transaction (/**use($Institucion)
         *
         */
            function () {




                $this->Institucion = institucion::create([
                'nombre'=>'Intitucion Prueba',
                'departamento'=>'Sucre',
                'direccion'=>'Troncal',
                'telefono'=>'20184017',
                'fecha_inicio'=>'2018-08-30',
                'fecha_final'=>'2018-10-30',

            ]);




        });



        DB::transaction(function () {
       $user = User::create([
             'nombres'=>'Usuario',
             'apellidos'=>'Admin',
             'username'=>'admin',
             'email'=>'lesly.bravol@cecar.edu.co',
             'password'=>bcrypt('Noabs20182'),

          ]);


            Admin::create([
               'user_id'=>$user->id,
                     ]);


        });



        DB::transaction(function (){



            $user= User::create([
                'nombres'=>'Estudiante',
                'apellidos'=>'Bertel',
                'username'=>'estudiante',
                'email'=>'andres.bertel@estudiante.com',
                'password'=>bcrypt('Bqg3rqfabt_'),

            ]);


            nino::create([
                'user_id'=>$user->id,
                'institucion_id'=>$this->Institucion->id,
                'fecha_nacimiento'=>'2018-10-30',
                'sexo'=>'Masculino',
                'departamento'=>'Sucre',
                'direccion'=>'Troncal',
                'activo'=>'1',
            ]);


        });

        DB::transaction(function ()   {

            $user= User::create([
                'nombres'=>'Gestor',
                'apellidos'=>'Bertel',
                'username'=>'gestor',
                'email'=>'andres.bertel@gestor.com',
                'password'=>bcrypt('Bqg3rqfabt_'),

            ]);


            Gestor::create([
                'user_id'=>$user->id,
                'institucion_id'=>$this->Institucion->id,
                'activo'=>'1',
            ]);


        });



    }
}
