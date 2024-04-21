<html>
   
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Noabs</title>




    <style>
        .centrardiv{
            margin-right: auto;
            margin-left: auto;
            float: initial;
        }
        @font-face {
    font-family: 'Courier';
    
}

html {
    font-family: 'Courier';
}

table {
    border-collapse: separate;
    text-indent: initial;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
    border-spacing: 2px;
    white-space: normal;
    font-variant: normal;
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }

    table {
   width: 100%;
   text-align: left;
   border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;
}
caption, td, th {
   padding: 0.3em;
}

td{
  align-content: center;
}
tbody {
   border-top: 1px solid #000;
   border-bottom: 1px solid #000;
}

    </style>

<link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<script src="{{asset('js/highcharts.js')}}"></script>
        <script src="{{asset('js/exporting.js')}}"></script>
        <script src="{{asset('js/export-data.js')}}"></script>
</head>



   

    <!-- Button trigger modal -->




<html>

  
<body>
  <header>
    <h1>Resultados del juego</h1>
    <h2>NOABS</h2>
  </header>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              www.noabs.cecar.edu.co</p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
  <div class="content">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Nombre</th>
                <th>Apellidos</th>               
                <th>Sexo</th>
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Institucion</th>
                <th>Respuestas</th>
                <th>Nivel de riesgo</th>
                <th>Riesgo por contexto</th>
                <th>Fecha realización test</th>
               
            </tr>
            </thead>
            <tbody>

            @forelse($respuestaGenerales as $respuesta)



                <tr data-nombre="{{$respuesta['user']->nombres}}" data-apellido="{{$respuesta['user']->apellidos}}" data-acertadad="{{$respuesta['respuesta']->acertadas}}" data-neutras="{{$respuesta['respuesta']->neutras}}" data-negativas="{{$respuesta['respuesta']->negativas}}">
                    <td >{{$respuesta['user']->nombres}}</td>
                    <td >{{$respuesta['user']->apellidos}}</td>
                   
                    <td>{{$respuesta['nino']->sexo}}</td>
                    <td>{{$respuesta['nino']->departamento}}</td>
                    <td>{{$respuesta['nino']->direccion}}</td>
                    <td>{{$respuesta['institucion']->nombre}}</td>

                    <td style="text-align: Left;">


                       
                            <li>
                              No - {{round((($respuesta['respuesta']->acertadas)*100)/$respuesta['respuesta']->totalPreguntas,1)}}% - ({{$respuesta['respuesta']->acertadas}})
                            </li>


                            <li>
                               No sé - {{round((($respuesta['respuesta']->neutras)*100)/$respuesta['respuesta']->totalPreguntas,1)}}% - ({{$respuesta['respuesta']->neutras}})
                           </li>

                            <li>
                              Si - {{round((($respuesta['respuesta']->negativas)*100)/$respuesta['respuesta']->totalPreguntas,1)}}% - ({{$respuesta['respuesta']->negativas}})
                            </li>
                       
                       
                    </td>
                         <td> <span style="font-weight: bold; text-align: center;"> {{$respuesta['respuesta']->riesgo }}</span></td>
                    <td>

                           <li><b>Familiar:</b>  {{$respuesta['respuesta']->cFamiliar}} </li>
                            <li><b>Escolar:</b> {{$respuesta['respuesta']->cEscolar}} </li>
                            <li><b>Social:</b> {{$respuesta['respuesta']->cSocial}} </li>
                            <li><b>Tecnológico:</b> {{$respuesta['respuesta']->cTecnologico}}</li>
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
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Institucion</th>
                <th>Respuestas</th>
                <th>Nivel de riesgo</th>
                <th>Riesgo por contexto</th>
                <th>Fecha realización test</th>
              
            </tr>
            </tfoot>
        </table>



<!-- Modal -->

            <div role="document">
                <div class="modal-content">
                   
                    <div >
                     
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Contexto</th>
                                <th scope="col">Pregunta</th>
                                <th scope="col">Respuesta</th>

                            </tr>
                            </thead>
                       
                            @php
                                $contador = 1; 
                            @endphp
                            @forelse($respuestaGenerales as $respuestapre)

                          
                            @foreach($respuestapre['preguntas'] as $index => $respuestap)

                            @php
                              $respuesta = $respuestaGenerales[0]['respuesta']->{'r'.($index+1)};
                              $style = '';
                              $respuestaNino = '';

                              switch ($respuesta) {
                                  case 1:
                                      $style = 'background-color:#ffcaca; color:black;';
                                      $respuestaNino = 'Si';
                                      break;
                                  case 2:
                                      $style = 'background-color:#ffd187; color:black;';
                                      $respuestaNino = 'No sé';
                                      break;
                                  case 3:
                                      $style = 'background-color:#b0f1d3; color:black;';
                                      $respuestaNino = 'No';
                                      break;
                              }
                          @endphp

                            <tr style="{{ $style }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $respuestap->contexto }}</td>
                                    <td>{{ $respuestap->pregunta }}</td>
                                    <td>{{ $respuestaNino }}</td>
                                </tr>
                            @endforeach
                              @empty
                                  <tr>
                                      <td colspan="4">No hay resultados disponibles.</td>
                                  </tr>
                              @endforelse
                         

                        </table>



                    </div>

                </div>
            </div>

        </div>

       






    </div>
  </div>
</body>
</html>
   
</html>
