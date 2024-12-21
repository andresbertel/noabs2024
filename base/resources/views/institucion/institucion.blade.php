

@extends('layouts.base')


@section('content')

    <div class="col-md-10 centrardiv" style="top:25px;">



        <div class="box box-info">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h1 >Registrar Institucion</h1>
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

                <form method="POST" class="form-horizontal" action="{{ route('registarinstitucion') }}">
                    @csrf

                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" id="nombre" class="col-sm-2 control-label">{{ __('Nombres Institución') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('departamento') ? '  has-error' : '' }}">
                        <label for="departamento" id="departamento" class="col-sm-2 control-label">{{ __('Departamento') }}</label>

                        <div class="col-md-6">
                            <input id="departamento" type="text" class="form-control" name="departamento" value="{{ old('departamento') }}" >


                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('direccion') ? '  has-error' : '' }}">
                        <label for="direccion" id="direccion" class="col-sm-2 control-label">{{ __('Direccion') }}</label>

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



                    <div class="form-group {{ $errors->has('fecha_final') ? ' has-error' : '' }}">
                        <label for="fecha_final" class="col-sm-2 control-label">{{ __('Fecha Final') }}</label>

                        <div class="col-md-6">
                                     <input type="text" class="form-control pull-right " name="fecha_final" id="fecha_final" data-date-format='yyyy-mm-dd' value="{{ old('fecha_final') }}">
                        </div>

                        </div>


                        
                    <div class="form-group {{ $errors->has('numero_test') ? '  has-error' : '' }}">
                        <label for="numero_test" id="numero_test" class="col-sm-2 control-label">{{ __('Número de aplicaciones') }}</label>

                        <div class="col-md-6">
                            <input id="numero_test" type="text" class="form-control" name="numero_test" value="{{ old('numero_test') }}" pattern="[0-9]*" title="Por favor, introduce solo números">


                        </div>
                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn  btn-primary btn-lg">
                            {{ __('Registrar Institución') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
