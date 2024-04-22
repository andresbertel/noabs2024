



        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre</th>               
                <th>Apellidos</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Curso</th>
                <th>Departamento</th>
                <th>Dirección</th>              
                <th>Institucion</th>              
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
                    <td> @php
                            // Obtener la fecha de nacimiento del niño
                            $fechaNacimiento = $respuesta['nino']->fecha_nacimiento;
                            
                            // Calcular la edad a partir de la fecha de nacimiento
                            $edad = \Carbon\Carbon::parse($fechaNacimiento)->age;
                            echo $edad; // Mostrar la edad en años
                       @endphp
                   </td>
                   <td>{{$respuesta['nino']->curso ?? '-'}}</td>
                    <td>{{$respuesta['nino']->departamento}}</td>
                    <td>{{$respuesta['nino']->direccion}}</td>
                    <td>{{$respuesta['institucion']->nombre}}</td>


                   

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
                <th>Edad</th>
                <th>Curso</th>
                <th>Departamento</th>
                <th>Dirección</th>              
                <th>Institucion</th>               
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

