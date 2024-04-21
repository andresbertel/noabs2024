

@extends('layouts.base')


@section('content')

    <div class="col-md-10 centrardiv" style="top:25px;">



        <div class="box box-info">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h1 >Registrar Gestor</h1>
                </div>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h4>Corregir los siguientes errores:</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" class="form-horizontal" action="{{ route('registergestor') }}">
                    @csrf

                    <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
                        <label for="nombres" id="nombres" class="col-sm-2 control-label">{{ __('Nombres Gestor') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('apellidos') ? '  has-error' : '' }}">
                        <label for="apellidos" id="apellidos" class="col-sm-2 control-label">{{ __('Apellidos Gestor') }}</label>

                        <div class="col-md-6">
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('username') ? '  has-error' : '' }}">
                        <label for="username" id="username" class="col-sm-2 control-label">{{ __('Usuario') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" >

                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('id_institucion') ? ' has-error' : '' }}">
                        <label for="id_institucion" class="col-sm-2 control-label">Institución</label>
                    <div class="col-md-6" >
                        <select class=" form-control " name="id_institucion" id="id_institucion">
                            <option value="{{old('id_institucion')}}">Escoger Institución...</option>
                           @foreach($instituciones as $institucion)
                            {{--<option value="{{$institucion->id}}"  @if(old('id_institucion') == $institucion->id) {{'selected'}} @else{{''}} @endif  >{{$institucion->nombre}}</option>--}}
                            <option value="{{$institucion->id}}"  {{  old('id_institucion') == $institucion->id ? 'selected' :'' }}  >{{$institucion->nombre}}</option>
                          @endforeach

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

                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-sm-2 control-label">{{ __('Confirmar Password') }}</label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>




                    <div class="box-footer">
                        <button type="submit" class="btn  btn-primary btn-lg">
                            {{ __('Registrar Gestor') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
