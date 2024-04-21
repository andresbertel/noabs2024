@extends('layouts.base')


@section('content')

    {{--{{dd($permitido)}}--}}
    @if($permitido)
    <div class="content">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Username</th>
                <th>Email</th>
                <th>Institucion</th>
                <th>Fecha de nacimiento</th>
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Juego</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($ninos as $nino)

                <tr>
                    <td>{{$nino->nombres_user}}</td>
                    <td>{{$nino->apellidos_user}}</td>
                    <td>{{$nino->username_user}}</td>
                    <td>{{$nino->email_user}}</td>
                    <td>{{$nino->nombre_institucion}}</td>
                    <td>{{$nino->fecha_nacimiento}}</td>
                    <td>{{$nino->departamento}}</td>
                    <td>{{$nino->direccion}}</td>
                    <td>{!! ($nino->activo===1)?"<span class='glyphicon glyphicon-remove'></span>":"<span class='glyphicon glyphicon-ok'></span>"!!}</td>
                    {{--<td>{{$nino['institucion_nombre']}}</td>--}}



                    <td>
                        <button type="button" date-id="{{$nino->id}}" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#myModal" onclick="
                                $('#name').val('{{$nino->nombres_user}}');
                                $('#apellidos').val('{{$nino->apellidos_user}}');
                                $('#email').val('{{$nino->email_user}}');
                                $('#sexo').val('{{$nino->sexo}}');
                                $('#username').val('{{$nino->username_user}}');
                                $('#departamento').val('{{$nino->departamento}}');
                                $('#fecha_nacimiento').val('{{$nino->fecha_nacimiento}}');
                                $('#direccion').val('{{$nino->direccion}}');
                                $('#id_institucion').val('{{$nino->institucion_id}}');
                                $('#hid').val('{{$nino->id}}');
                                $('#huser_id').val('{{$nino->user_id}}');
                                $('#activo').val('{{$nino->activo}}');



                                ">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        {{--<button type="button" class="btn btn-default" aria-label="Left Align">--}}
                            {{--<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>--}}
                        {{--</button>--}}

                    </td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Username</th>
                <th>Email</th>
                <th>Institucion</th>
                <th>Fecha de nacimiento</th>
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Juego</th>
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
                    <h4 class="modal-title" id="myModalLabel">Actualizar Niño| Niña</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal" action="{{ route("actualizarNino") }}">
                        @csrf

                        <input id="huser_id" name="huser_id" type="hidden">
                        <input id ="hid" name="hid" type="hidden">

                        <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
                            <label for="nombres" id="nombres" class="col-sm-2 control-label">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" >


                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('apellidos') ? '  has-error' : '' }}">
                            <label for="apellidos"  class="col-sm-2 control-label">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" >


                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sexo') ? ' has-error' : '' }}">
                            <label for="sexo" class="col-sm-2 control-label">Sexo</label>
                            <div class="col-md-6" >
                                <select class=" form-control " name="sexo" id="sexo">
                                    <option value="{{old('sexo')}}">Escoger Sexo...</option>
                                    {{--<option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>--}}
                                    <option value="Masculino"  {{  old('sexo') == 'Masculino' ? 'selected' :'' }}  >Masculino</option>
                                    <option value="Femenino"  {{  old('sexo') == 'Femenino' ? 'selected' :'' }}  >Femenino</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('username') ? '  has-error' : '' }}">
                            <label for="username"  class="col-sm-2 control-label">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" >

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('id_institucion') ? ' has-error' : '' }}">
                            <label for="id_institucion" class="col-sm-2 control-label">Institución</label>
                            <div class="col-md-6" >
                                <select class=" form-control " name="id_institucion" id="id_institucion">
                                    @if($instituciones->count()<='1')
                                    @else
                                        <option value="{{old('id_institucion')}}">Escoger Institución...</option>
                                    @endif


                                    @foreach($instituciones as $institucion )
                                        {{--<option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>--}}
                                        <option value="{{$institucion->id}}"  {{  old('id_institucion') == $nino->institucion_id? 'selected' :'' }}  >{{$institucion->nombre}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                            <label for="fecha_nacimiento" class="col-sm-2 control-label">{{ __('Fecha de Nacimiento') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control pull-right " name="fecha_nacimiento" id="fecha_nacimiento" data-date-format='yyyy-mm-dd' value="{{ old('fecha_nacimiento') }}">
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('departamento') ? ' has-error' : '' }}">
                            <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                            <div class="col-md-6" >
                                <select class=" form-control " name="departamento" id="departamento">
                                    <option value="{{old('departamento')}}">Escoger Departamento...</option>
                                    {{--<option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>--}}
                                    <option value="Sucre"  {{  old('id_institucion') == 'Sucre'? 'selected' :'' }}  >Sucre</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-sm-2 control-label">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" >

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-2 control-label">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('activo') ? ' has-error' : '' }}">
                            <label for="activo" class="col-sm-2 control-label">{{ __('Activo') }}</label>

                            <div class="col-md-6">
                                <select class=" form-control " name="activo" id="activo">
                                    <option value="{{old('activo')}}">Escoger Estado...</option>
                                    {{--<option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>--}}
                                    <option value="1"  {{  old('activo') == '1'? 'selected' :'' }}  >Activo</option>
                                    <option value="0"  {{  old('activo') == '0'? 'selected' :'' }}  >No activo</option>

                                </select>

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-2 control-label">{{ __('password') }}</label>

                            <div class="col-md-6">


                                <input type="password" class="form-control pull-right " name="password" id="password" data-date-format='yyyy-mm-dd' value="{{ old('password') }}">


                            </div>


                        </div>






                        <div class="box-footer">
                            <button type="submit" class="btn  btn-primary btn-lg">
                                {{ __('Actualizar Nino | Niña') }}
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
        @else
        <div class="alert alert-danger" ><h1 style="text-align: center">El tiempo de utilización ha finalizado.</h1></div>
@endif
@endsection
