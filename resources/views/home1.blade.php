@extends('layouts.base')

<style>

    #flashContent { width:100%; height:100%; }
</style>

@section('content')
<div >

    @can('isAdmin',Auth::user())

   @endcan

        @can('isGestor',Auth::user())

        @endcan
        @can('isNino',Auth::user())
       @if($permitido)
            @if(Auth::user()->nino->get(0)->activo===1)
                    @if(Auth::user()->nino->get(0)->sexo==='Masculino')
                        <div>
					<h1>HOLAAA</h1>
					        <object data="{{asset('swf/nino/nino.html')}}" width="500" height="200"></object>	                            
                        </div>
                        @else
<h1>HOLAAA</h1>
                        <div>
                             <object data="{{asset('swf/nino/nino.html')}}" width="500" height="200"></object>	
                        </div>

                        @endif


                @else
                <div class="alert alert-info"><h1 style="text-align: center">Este usuario ya posee respuestas registradas</h1></div>
            @endif
            @else
                <div class="alert alert-danger"><h1 style="text-align: center">El tiempo de utilización ha finalizado.</h1></div>
           @endif
        @endcan
        <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(function() {

                $('#juego2').width('100%').height('100%');
            });
        });


    </script>
</div>
@endsection
