<table id="example1" class="table table-bordered table-striped">
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
            <tbody>

            @forelse($respuestaGenerales as $respuesta)

            <tr data-nombre="{{$respuesta['user']->nombres}}" data-apellido="{{$respuesta['user']->apellidos}}" data-acertadad="{{$respuesta['respuesta']->acertadas}}" data-neutras="{{$respuesta['respuesta']->neutras}}" data-negativas="{{$respuesta['respuesta']->negativas}}">
                    <td >{{$respuesta['user']->nombres}}</td>
                    <td >{{$respuesta['user']->apellidos}}</td>                   
                    <td>{{$respuesta['nino']->sexo}}</td> 
                    <td>{{$respuesta['nino']->fecha_nacimiento}}</td> 
                    <td> @php
                            // Obtener la fecha de nacimiento del niño
                            $fechaNacimiento = $respuesta['nino']->fecha_nacimiento;
                            
                            // Calcular la edad a partir de la fecha de nacimiento
                            $edad = \Carbon\Carbon::parse($fechaNacimiento)->age;
                            echo $edad; // Mostrar la edad en años
                       @endphp
                   </td>

                   <td> @php
                   // Obtener la fecha de realización y la fecha de nacimiento
                    $fechaRealizacion = $respuesta['respuesta']->fecha_realizacion;
                    $fechaNacimiento = $respuesta['nino']->fecha_nacimiento;

                    // Calcular la diferencia en años entre las dos fechas
                    $edadTest = \Carbon\Carbon::parse($fechaNacimiento)->diffInYears(\Carbon\Carbon::parse($fechaRealizacion));

                    // Mostrar la diferencia en años
                    echo $edadTest;
                       @endphp
                   </td>
                   <td>{{$respuesta['nino']->curso ?? '-'}}</td>
                    <td>{{$respuesta['nino']->departamento}}</td>
                    <td>{{$respuesta['nino']->direccion}}</td>
                    <td>{{$respuesta['institucion']->nombre}}</td>

                    <td>{{$respuesta['respuesta']->r1}}</td>
                    <td>{{$respuesta['respuesta']->r2}}</td>
                    <td>{{$respuesta['respuesta']->r3}}</td>
                    <td>{{$respuesta['respuesta']->r4}}</td>
                    <td>{{$respuesta['respuesta']->r5}}</td>
                    <td>{{$respuesta['respuesta']->r6}}</td>
                    <td>{{$respuesta['respuesta']->r7}}</td>
                    <td>{{$respuesta['respuesta']->r8}}</td>
                    <td>{{$respuesta['respuesta']->r9}}</td>
                    <td>{{$respuesta['respuesta']->r10}}</td>
                    <td>{{$respuesta['respuesta']->r11}}</td>
                    <td>{{$respuesta['respuesta']->r12}}</td>
                    <td>{{$respuesta['respuesta']->r13}}</td>
                    <td>{{$respuesta['respuesta']->r14}}</td>
                    <td>{{$respuesta['respuesta']->r15}}</td>

                   

                    <td>{{$respuesta['respuesta']->acertadas}}</td>
                    <td>{{$respuesta['respuesta']->neutras}}</td>
                    <td>{{$respuesta['respuesta']->negativas}}</td>

                    <td style="text-align: Left;">
                        <span style="font-weight: bold; text-align: center;">{{$respuesta['respuesta']->riesgo }}</span>
                    </td>

                    <td>
                           {{$respuesta['respuesta']->cFamiliar}}                          
                    </td>

                    <td>                         
                       {{$respuesta['respuesta']->cEscolar}}                         
                    </td>

                    <td>                          
                             {{$respuesta['respuesta']->cSocial}}                           
                    </td>

                    <td>                          
                     {{$respuesta['respuesta']->cTecnologico}}
                    </td>

                    <td>{{$respuesta['respuesta']->fecha_realizacion}}</td>

                 
                </tr>

               
                @empty
                <h1>NO HAY RESULATADOS RESGISTRADOS</h1>

            @endforelse
            </tbody>
            <tfoot>
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
            </tfoot>
        </table>