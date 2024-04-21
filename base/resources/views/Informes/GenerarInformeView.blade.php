@extends('layouts.base')

@section('content')
    <div style="margin: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generar Informe</div>

                    <div class="card-body">
                        <form  method="GET"  action="{{ route("inforinst",':institucion') }}"  id="informeForm">
                       
                            @csrf
                    </form>

        

                            <div class="form-group">
                                <label for="institucionSelect">Seleccione institución</label>
                                <select class="form-control" id="institucionSelect" name="idInst">
                                    @foreach ($instituciones as $institucion)
                                        <option value="{{ $institucion->id }}">{{ $institucion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                       

                        <button  id="generarInformeBtn" class="btn btn-primary botonShowDetails">Generar Informe</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="vistaParcialContainer"></div>
        <div id="cargando" style="display: none;">Cargando...</div>



    </div>
@endsection

@section('script')
    <script>
   
         $('document').ready(function(){
          

                $('.botonShowDetails').click(function (e) {
                 
                e.preventDefault();
                $('#modalCarga').modal('show');
                var id = $('#institucionSelect').val();

                var form =  $('#informeForm');
                var url = form.attr('action').replace(':institucion',id);
                var data = form.serialize();

                $.get(url,data, function (respuesta){

                    $('#modalCarga').modal('hide');
                    var vistaparcial = $('#vistaParcialContainer');
                    vistaparcial.empty();
                    vistaparcial.append(respuesta);

                  
                     
                    });

                });

});


      

       </script>   
   
@endsection
