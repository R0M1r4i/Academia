@extends('layout.app2')

@section('content')

    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Docente /</span> Datos Generales</h4>
                <!-- Card Groups -->
                <div class="card-group mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos Generales</h5>

                            <div class="col">
                                <p class="font-weight-bold">Nombre:</p>
                                <p >{{ $docente->nombre_docente }} {{ $docente->apellido_docente }}</p>
                            </div>
                            <div class="col">
                                <P class="font-weight-bold">DNI:</P>
                                <p >{{ $docente->dni_docente }}</p>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Rendimiento:</p>
                                <p>{{ $docente->rendimiento }}</p>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Puntaje:</p>
                            </div>

                        </div>
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Asistencia</h5>
                            <div class="  " style="text-align: center; height: 200px;">
                                <canvas id="myChart"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Card Groups -->


                <!-- Striped Rows Asistencia -->
                <div class="card">
                    <h5 class="card-header">Asistencia</h5>
                    <div class="demo-inline-spacing mb-2 mx-3">

                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Asistencia</th>
                                <th>Valor</th>
                                <th>Hora</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($asistencia as $asist)
                                <tr>
                                    <td><p STYLE="display: none">{{ $asist->id_asistencia }}</p>Dia</td>
                                    <td>{{ $asist->valor_asistencia }}</td>
                                    <td>{{ $asist->hora }}</td>
                                    <td>{{ $asist->fecha }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15">No hay asistencias.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $asistencia->links() }}

                    </div>
                </div>
                <!--/ Striped Rows Asistencia -->

            </div>
        </div>
        <!--/ Layout Demo -->
    </div>
    <!-- / Content -->


    <!-- Scripts -->

    <script>
        // Obtén una referencia al elemento canvas
        const canvas = document.getElementById('myChart');

        // Define las variables en JavaScript
        const asistencias = @json($asistencias_count);
        const tardanzas = @json($tardanzas_count);
        const inasistencias = @json($inasistencias_count);

        // Crea una instancia del gráfico de dona
        const chart = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: ['Asistencia', 'Tardanza', 'Inasistencia'],
                datasets: [{

                    data: [asistencias, tardanzas, inasistencias],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'RGBA(189, 183, 107, 1)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'RGBA( 189, 183, 107, 1 )',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>



    <script>
        $(document).ready(function() {
            // Obtener todas las filas de la tabla
            var filas = $("table tbody tr");

            // Mostrar el contador de filas inicial
            $("#contador-filas").text("Número de Registros: " + filas.length );

            // Evento de clic en el botón de búsqueda
            $("#btn-buscar").click(function() {
                var valor = $("#txt-buscar").val().toLowerCase();

                // Filtrar las filas de la tabla según el valor de búsqueda
                filas.filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
                });

                // Actualizar el contador de filas
                var filasFiltradas = $("table tbody tr:visible");
                $("#contador-filas").text( "Número de Registros: " +filasFiltradas.length);
            });

            // Evento de cambio en el campo de búsqueda
            $("#txt-buscar").on("input", function() {
                // Si se borra el texto del campo de búsqueda, realizar la búsqueda nuevamente
                if ($(this).val() === "") {
                    filas.show();
                }

                // Actualizar el contador de filas
                var filasFiltradas = $("table tbody tr:visible");
                $("#contador-filas").text("Número de filas: " + filasFiltradas.length);
            });
        });
    </script>

    <script>
        //asignar evento click a todos los botones con nombre de clase "btn-editar"
        //Para este caso usaremos JQUERY
        $(document).on("click",".btn-editar",function(){
            //variables
            let id_asistencia = $(this).data('id');
            let valor_asistencia = $(this).data('valor');
            let estudiante_id_estudiante = $(this).data('estudiante');
            let hora = $(this).data('hora');
            let fecha = $(this).data('fecha');

            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-id").val(id_asistencia);
            $("#txt-valor").val(valor_asistencia);
            $("#txt-estudiante").val(estudiante_id_estudiante);
            $("#txt-hora").val(hora);
            $("#txt-fecha").val(fecha);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('asistencia.update', ':id') }}";
            url = url.replace(':id', id_asistencia);
            $('#form-editar').attr('action', url);
        })
    </script>

    <script>
        // Write on keyup event of keyword input element
        $(document).ready(function(){
            $("#search").keyup(function(){
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#mytable tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
    </script>

    <script>

        <!-- Script para obtener la fecha actual -->

        document.addEventListener("DOMContentLoaded", function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //Enero es 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('dobLarge').value = today;
        });


    </script>
    <!-- / Scripts -->






@endsection

