@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">



                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Login NOABS 3.0</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-10">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password"  id="inputPassword3" placeholder="Password" id="password"  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                        <!-- /.box-body -->
                        <div class="box-footer">


                            <button type="submit" class="btn btn-info pull-right">
                                {{ __('Login') }}
                            </button>


                        </div>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>



        </div>
    </div>
</div>

@endsection
