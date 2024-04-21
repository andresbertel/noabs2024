@extends('layouts.base')


@section('content')
    <div class="content">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Username</th>
                <th>Email</th>
                <th>Institucion</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gestores as $gestor)

                <tr>




                    <td>{{$gestor['nombres']}}</td>
                    <td>{{$gestor['apellidos']}}</td>
                    <td>{{$gestor['username']}}</td>
                    <td>{{$gestor['email']}}</td>
                    <td>{{$gestor['institucion_nombre']}}</td>



                    <td>
                        <button type="button" date-id="{{$gestor['id_user']}}" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#myModal" onclick="
                                $('#id').val('{{$gestor['id_user']}}');
                                $('#name').val('{{$gestor['nombres']}}');
                                $('#apellidos').val('{{$gestor['apellidos']}}');
                                $('#username').val('{{$gestor['username']}}');
                                $('#id_institucion').val('{{$gestor['id_institucion']}}');
                                $('#email').val('{{$gestor['email']}}');


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
                    <h4 class="modal-title" id="myModalLabel">Actualizar Gestor</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal" action="{{ route('actualizarGestor') }}">
                        @csrf

                        <input id="id" type="hidden" class="form-control" name="id" value="{{ old('id') }}" >

                        <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
                            <label for="nombres" id="nombres" class="col-sm-2 control-label">{{ __('Nombres Gestor') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" >


                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('apellidos') ? '  has-error' : '' }}">
                            <label for="apellidos"  class="col-sm-2 control-label">{{ __('Apellidos Gestor') }}</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" >


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
                                    <option value="{{old('id_institucion')}}">Escoger Institución...</option>
                                    @forelse($instituciones as $institucion)
                                        <option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>
                                        {{--<option value="{{$institucion->id}}"  {{  old('id_institucion') == $institucion->id ? 'selected' :'' }}  >{{$institucion->nombre}}</option>--}}
                                      @empty
                                        <p>No hay instituciones registradas..</p>
                                    @endforelse

                                </select>
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-sm-2 control-label">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-2 control-label">{{ __('password') }}</label>

                            <div class="col-md-6">


                                <input type="password" class="form-control pull-right " name="password" id="password" data-date-format='yyyy-mm-dd' value="{{ old('password') }}">


                            </div>


                        </div>



                        <div class="modal-footer" style="text-align: left;">

                            <button type="submit" class="btn btn-primary"> {{ __('Actualizar Gestor') }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
