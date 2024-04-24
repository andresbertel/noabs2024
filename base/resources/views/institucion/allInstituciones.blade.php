

@extends('layouts.base')


@section('content')
<div class="content">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Número de aplicaciones</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($instituciones as $institucion)
        <tr>
            <td>{{$institucion->nombre}}</td>
            <td>{{$institucion->departamento}}</td>
            <td>{{$institucion->direccion}}</td>
            <td>{{$institucion->telefono}}</td>
            <td>{{$institucion->fecha_inicio}}</td>
            <td>{{$institucion->fecha_final}}</td>
            <td>{{$institucion->numero_test}}</td>
           
            <td>
                <button type="button" date-id="{{$institucion->id}}" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#myModal" onclick="
                        $('#id').val('{{$institucion->id}}');
                        $('#name').val('{{$institucion->nombre}}');
                        $('#departamento').val('{{$institucion->departamento}}');
                        $('#direccion').val('{{$institucion->direccion}}');
                        $('#telefono').val('{{$institucion->telefono}}');
                        $('#fecha_inicio').val('{{$institucion->fecha_inicio}}');
                        $('#fecha_final').val('{{$institucion->fecha_final}}');
                        $('#numero_test').val('{{$institucion->numero_test}}');
               ">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                

            </td>
        </tr>
     @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Número de aplicaciones</th>
            <th>Opciones</th>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Instituciòn</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" action="{{ route('actualizarinstitucion') }}">
                    @csrf

                    <input id="id" type="hidden" class="form-control" name="id" value="{{ old('id') }}" >

                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" id="nombre" class="col-sm-2 control-label">{{ __('Nombres Institución') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('departamento') ? '  has-error' : '' }}">
                        <label for="departamento" class="col-sm-2 control-label">{{ __('Departamento') }}</label>

                        <div class="col-md-6">
                            <input id="departamento" type="text" class="form-control" name="departamento" value="{{ old('departamento') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('direccion') ? '  has-error' : '' }}">
                        <label for="direccion"  class="col-sm-2 control-label">{{ __('Direccion') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" >

                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                        <label for="telefono" class="col-sm-2 control-label">{{ __('Telefono') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="tel" class="form-control" name="telefono" value="{{ old('telefono') }}" >

                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                        <label for="fecha_inicio" class="col-sm-2 control-label">{{ __('Fecha Inicio') }}</label>

                        <div class="col-md-6">


                            <input type="text" class="form-control pull-right " name="fecha_inicio" id="fecha_inicio" data-date-format='yyyy-mm-dd' value="{{ old('fecha_inicio') }}">


                        </div>


                    </div>

                    <div class="form-group {{ $errors->has('fecha_final') ? ' has-error' : '' }}">
                        <label for="fecha_final" class="col-sm-2 control-label">{{ __('Fecha Final') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control pull-right " name="fecha_final" id="fecha_final" data-date-format='yyyy-mm-dd' value="{{ old('fecha_final') }}">
                        </div>

                    </div>

                    <div class="form-group {{ $errors->has('numero_test') ? '  has-error' : '' }}">
                        <label for="numero_test" class="col-sm-2 control-label">{{ __('Número de aplicaciones') }}</label>

                        <div class="col-md-6">
                            <input id="numero_test" type="text" class="form-control" name="numero_test" value="{{ old('numero_test') }}" pattern="[0-9]*" title="Por favor, introduce solo números">


                        </div>
                    </div>




                    <div class="modal-footer" style="text-align: left;">

                        <button type="submit" class="btn btn-primary"> {{ __('Actualizar Institución') }}</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection
