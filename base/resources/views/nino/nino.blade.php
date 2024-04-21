

@extends('layouts.base')

@section('content')
    @if($permitido)

<div class="col-md-10 centrardiv" style="top:5px;">

<div class="box box-info">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h1 >Registro masivo por CSV</h1>                    
                </div>



                <form method="POST" action="{{ route('cargar.usuarios') }}" enctype="multipart/form-data" style="padding: 30px;">
                        @csrf
                      
                        <div class="form-group">
                            <label for="csv_file">Seleccionar archivo CSV:</label>
                            <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv">
                        </div>

                        <button type="submit" class="btn btn-primary">Cargar usuarios</button> |
                        <a href="{{ route('descargar.csv') }}">  Descargar ejemplo archivo CSV</a>
                    </form>
                   
            </div>
  </div>
                
</div>





    <div class="col-md-10 centrardiv" style="top:5px;">



        <div class="box box-info">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h1 >Registrar Niño | Niña</h1>                    
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

                <form method="POST" class="form-horizontal" action="{{ route('registarninos') }}">
                    @csrf

                    <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
                        <label for="nombres" id="nombres" class="col-sm-2 control-label">{{ __('Nombres') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('apellidos') ? '  has-error' : '' }}">
                        <label for="apellidos" id="apellidos" class="col-sm-2 control-label">{{ __('Apellidos') }}</label>

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
                        <label for="username" id="username" class="col-sm-2 control-label">{{ __('Usuario') }}</label>

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
                                    <option value="{{$institucion->id}}"  {{  old('id_institucion') == $institucion->id? 'selected' :'' }}  > {{$institucion->id}} - {{$institucion->nombre}}</option>
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
                                <option value="Amazonas"  {{  old('id_institucion') == 'Amazonas'? 'selected' :'' }}  >Amazonas</option>
                                <option value="Antioquia"  {{  old('id_institucion') == 'Antioquia'? 'selected' :'' }}  >Antioquia</option>
                                <option value="Antioquia"  {{  old('id_institucion') == 'Antioquia'? 'selected' :'' }}  >Antioquia</option>
                                <option value="Atlántico"  {{  old('id_institucion') == 'Atlántico'? 'selected' :'' }}  >Atlántico</option>
                                <option value="Bolívar"  {{  old('id_institucion') == 'Bolívar'? 'selected' :'' }}  >Bolívar</option>
                                <option value="Boyacá"  {{  old('id_institucion') == 'Boyacá'? 'selected' :'' }}  >Boyacá</option>
                                <option value="Caldas"  {{  old('id_institucion') == 'Caldas'? 'selected' :'' }}  >Caldas</option>
                                <option value="Caquetá"  {{  old('id_institucion') == 'Caquetá'? 'selected' :'' }}  >Caquetá</option>
                                <option value="Casanare"  {{  old('id_institucion') == 'Casanare'? 'selected' :'' }}  >Casanare</option>
                                <option value="Cauca"  {{  old('id_institucion') == 'Cauca'? 'selected' :'' }}  >Cauca</option>
                                <option value="Cesar"  {{  old('id_institucion') == 'Cesar'? 'selected' :'' }}  >Cesar</option>
                                <option value="Chocó"  {{  old('id_institucion') == 'Chocó'? 'selected' :'' }}  >Chocó</option>
                                <option value="Córdoba"  {{  old('id_institucion') == 'Córdoba'? 'selected' :'' }}  >Córdoba</option>
                                <option value="Cundinamarca"  {{  old('id_institucion') == 'Cundinamarca'? 'selected' :'' }}  >Cundinamarca</option>
                                <option value="Güainia"  {{  old('id_institucion') == 'Güainia'? 'selected' :'' }}  >Güainia</option>
                                <option value="Guaviare"  {{  old('id_institucion') == 'Guaviare'? 'selected' :'' }}  >Guaviare</option>
                                <option value="Huila"  {{  old('id_institucion') == 'Huila'? 'selected' :'' }}  >Huila</option>
                                <option value="La Guajira"  {{  old('id_institucion') == 'La Guajira'? 'selected' :'' }}  >La Guajira</option>
                                <option value="Magdalena"  {{  old('id_institucion') == 'Magdalena'? 'selected' :'' }}  >Magdalena</option>
                                <option value="Meta"  {{  old('id_institucion') == 'Meta'? 'selected' :'' }}  >Meta</option>
                                <option value="Nariño"  {{  old('id_institucion') == 'Nariño'? 'selected' :'' }}  >Nariño</option>
                                <option value="Norte de Santander"  {{  old('id_institucion') == 'Norte de Santander'? 'selected' :'' }}  >Norte de Santander</option>
                                <option value="Putumayo"  {{  old('id_institucion') == 'Putumayo'? 'selected' :'' }}  >Putumayo</option>
                                <option value="Quindío"  {{  old('id_institucion') == 'Quindío'? 'selected' :'' }}  >Quindío</option>
                                <option value="Risaralda"  {{  old('id_institucion') == 'Risaralda'? 'selected' :'' }}  >Risaralda</option>
                                <option value="San Andrés y Providencia"  {{  old('id_institucion') == 'San Andrés y Providencia'? 'selected' :'' }}  >San Andrés y Providencia</option>
                                <option value="Santander"  {{  old('id_institucion') == 'Santander'? 'selected' :'' }}  >Santander</option>
                                <option value="Sucre"  {{  old('id_institucion') == 'Sucre'? 'selected' :'' }}  >Sucre</option>
                                <option value="Tolima"  {{  old('id_institucion') == 'Tolima'? 'selected' :'' }}  >Tolima</option>
                                <option value="Valle del Cauca"  {{  old('id_institucion') == 'Valle del Cauca'? 'selected' :'' }}  >Valle del Cauca</option>
                                <option value="Vaupés"  {{  old('id_institucion') == 'Vaupés'? 'selected' :'' }}  >Vaupés</option>
                                <option value="Vichada"  {{  old('id_institucion') == 'Vichada'? 'selected' :'' }}  >Vichada</option>

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
                            {{ __('Registrar Nino | Niña') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-danger"><h1 style="text-align: center">El tiempo de utilización ha finalizado.</h1></div>
    @endif


@endsection
