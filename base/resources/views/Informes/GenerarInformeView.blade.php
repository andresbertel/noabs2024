@extends('layouts.base')

@section('content')
    <div style="margin: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generar Informe</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('inforinst', ':institucion') }}" id="informeForm">
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

                        <!-- Botones para exportar en Excel y CSV -->
                        <div class="mt-3">
                            <button id="generarInformeBtn" class="btn btn-primary botonShowDetails">Generar Informe</button>
                            <button id="exportarExcelBtn" class="btn btn-success">Descargar en Excel (.xls)</button>
                            <button id="exportarCSVBtn" class="btn btn-info">Descargar en CSV (.csv)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cargando flotante -->
        <div id="cargando" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0, 0, 0, 0.5); color: white; padding: 20px; border-radius: 5px;">
            Cargando...
        </div>

        <div id="vistaParcialContainer"></div>
    </div>
@endsection

@section('script')
    <script>
        $('document').ready(function() {

            // Función para generar informe
            $('.botonShowDetails').click(function(e) {
                e.preventDefault();
                $('#cargando').show();  // Mostrar cargando flotante
                var id = $('#institucionSelect').val();

                var form = $('#informeForm');
                var url = form.attr('action').replace(':institucion', id);
                var data = form.serialize();

                $.get(url, data, function(respuesta) {
                    $('#cargando').hide();  // Ocultar cargando flotante
                    var vistaparcial = $('#vistaParcialContainer');
                    vistaparcial.empty();
                    vistaparcial.append(respuesta);
                });
            });

            // Botón para exportar a Excel
            $('#exportarExcelBtn').click(function(e) {
                e.preventDefault();
                $('#cargando').show();  // Mostrar cargando flotante
                var id = $('#institucionSelect').val();
                var url = '{{ route("exportarExcel", ":idInst") }}'.replace(':idInst', id);
                window.location.href = url; // Redirige a la URL de exportación
                setTimeout(function() { $('#cargando').hide(); }, 3000); // Ocultar después de un tiempo (si es necesario)
            });

            // Botón para exportar a CSV
            $('#exportarCSVBtn').click(function(e) {
                e.preventDefault();
                $('#cargando').show();  // Mostrar cargando flotante
                var id = $('#institucionSelect').val();
                var url = '{{ route("exportarCSV", ":idInst") }}'.replace(':idInst', id);
                window.location.href = url; // Redirige a la URL de exportación
                setTimeout(function() { $('#cargando').hide(); }, 3000); // Ocultar después de un tiempo (si es necesario)
            });

        });
    </script>
@endsection
