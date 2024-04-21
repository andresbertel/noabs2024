@extends('layouts.base')


@section('content')

    {{--{{dd($permitido)}}--}}

        <div class="content">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Departamento</th>
                    <th>Dirección</th>
                    <th>Institucion</th>
                    <th>Nivel de riesgo</th>
                    <th>Riesgo por contexto</th>
                    <th>Fecha realización test</th>
                    <th>Detalle resultado</th>
                </tr>
                </thead>
                <tbody>

                @forelse($respuestaGenerales as $respuesta)



                    <tr data-nombre="{{$respuesta['user']->nombres}}" data-apellido="{{$respuesta['user']->apellidos}}" data-acertadad="{{$respuesta['respuesta']->acertadas}}" data-neutras="{{$respuesta['respuesta']->neutras}}" data-negativas="{{$respuesta['respuesta']->negativas}}">
                        <td >{{$respuesta['user']->nombres}}</td>
                        <td >{{$respuesta['user']->apellidos}}</td>
                        <td>{{$respuesta['user']->email}}</td>
                        <td>{{$respuesta['nino']->sexo}}</td>
                        <td>{{$respuesta['nino']->departamento}}</td>
                        <td>{{$respuesta['nino']->direccion}}</td>
                        <td>{{$respuesta['institucion']->nombre}}</td>

                        <td style="text-align: center;">


                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: {{round((($respuesta['respuesta']->acertadas)*100)/$respuesta['respuesta']->totalPreguntas,1)}}%">
                                    <span >{{$respuesta['respuesta']->acertadas}}</span>
                                </div>


                                <div class="progress-bar progress-bar-warning" style="width: {{round((($respuesta['respuesta']->neutras)*100)/$respuesta['respuesta']->totalPreguntas,1)}}%">
                                    <span >{{$respuesta['respuesta']->neutras}}</span>
                                </div>

                                <div class="progress-bar progress-bar-danger" style="width: {{round((($respuesta['respuesta']->negativas)*100)/$respuesta['respuesta']->totalPreguntas,1)}}%">
                                    <span  >{{$respuesta['respuesta']->negativas}}</span>
                                </div>
                            </div>
                            <span style="font-weight: bold;">{{$respuesta['respuesta']->riesgo }}</span>
                        </td>

                        <td>

                               <li><b>Familiar:</b>  {{$respuesta['respuesta']->cFamiliar}} </li>
                                <li><b>Escolar:</b> {{$respuesta['respuesta']->cEscolar}} </li>
                                <li><b>Social:</b> {{$respuesta['respuesta']->cSocial}} </li>
                                <li><b>Tecnológico:</b> {{$respuesta['respuesta']->cTecnologico}}</li>




                        </td>

                        <td>{{$respuesta['respuesta']->fecha_realizacion}}</td>

                       <td style="text-align: center">
                            <button type="button"  class="btn btn-default" aria-label="Left Align" data-id="{{$respuesta['respuesta']->id}}" data-toggle="modal" data-target="#exampleModal" >
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </button>


                        </td>
                    </tr>
                    @empty
                    <h1>NO HAY RESULATADOS RESGISTRADOS</h1>

                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Departamento</th>
                    <th>Dirección</th>
                    <th>Institucion</th>
                    <th>Nivel de riesgo</th>
                    <th>Riesgo por contexto</th>
                    <th>Fecha realización test</th>
                    <th>Detalle resultado</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <!-- Button trigger modal -->



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualizar Niño| Niña</h4>

                    </div>
                    <div  class="modal-body">
                        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Contexto</th>
                                <th scope="col">Pregunta</th>
                                <th scope="col">Respuesta</th>

                            </tr>
                            </thead>
                            <tbody id="tablaResultados">

                            </tbody>

                        </table>



                    </div>

                </div>
            </div>



        </div>

    <form method="POST"  action="{{ route("respuestasNinoId",':USER_ID') }}" id="formbuscar">
        @csrf
    </form>



    <script src="{{asset('js/highcharts.js')}}"></script>
    <script src="{{asset('js/exporting.js')}}"></script>
    <script src="{{asset('js/export-data.js')}}"></script>


@endsection

@section('script')
    <script>
        $('document').ready(function(){




            $('.btn-default').click(function (e) {

                e.preventDefault();
            var nombres = $(this).parent().parent().data('nombre');
            var apellidos = $(this).parent().parent().data('apellido');
            var resSi = $(this).parent().parent().data('negativas');
            var resNose = $(this).parent().parent().data('neutras');
            var resNo = $(this).parent().parent().data('acertadad');
            var id = $(this).data('id');
            var form =  $('#formbuscar');
            var url = form.attr('action').replace(':USER_ID',id);
            var data = form.serialize();

                $.post(url,data, function (respuesta){

                    console.log(respuesta.resultados[0]);

                  var listaUsuarios =  $('#tablaResultados');

                    listaUsuarios.children().remove();
                    var x=0;
                  $.each(respuesta.resultados[0],function (index,elemento) {

//                      for(var i in respuesta.resultados[0]) {

                          listaUsuarios.append(
                              "<tr"+((elemento===1)?' style= \'background-color:#ffcaca; color:black;\'':(elemento===2)?' style= \'background-color:#ffd187; color:black;\'':(elemento===3)?' style= \'background-color:#b0f1d3; color:black;\'':'')+">"
                          +   "<th scope='row'>"+(x+1)+"</th>"
                          +   "<td>"+respuesta.preguntas[x].contexto+"</td>"
                          +   "<td>"+respuesta.preguntas[x].pregunta+"</td>"
                         +   "<td id="+index+">"+((elemento===1)?'si':(elemento===2)?'No sé':'No')+"</td>"
                          +   "</tr>"


                      );
                          x = x +1;
                  });

                    $('#myModalLabel').text("Detalles de resultado | "+nombres+" "+apellidos);

                    Highcharts.chart('container', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Detalle Juego NOABS'

                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Numero Preguntas',
                            colorByPoint: true,
                            data: [ {
                                name: 'SI',
                                y: resSi,
                                color: '#FF0000'


                            }, {
                                name: 'NO SÉ',
                                y: resNose,
                                color: '#ff942e'
                            }, {
                                name: 'NO',
                                y: resNo,
                                color: '#00a65a'
                            }]
                        }]
                    });

            });

            });
        });
    </script>

@endsection
