@extends('layout.app')

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
                                <p>{{ $docente->nombre_docente }} {{ $docente->apellido_docente }}</p>
                            </div>
                            <div class="col">
                                <P class="font-weight-bold">DNI:</P>
                                <p>{{ $docente->dni_docente }}</p>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Rendimiento:</p>
                                <p> {{ $docente->rendimiento }} </p>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold">Calificacion:</p>
                                <p> </p>
                            </div>

                        </div>
                    </div>


                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Informacion para Docentes</h5>
                            <div class="col">

                                <a href="{{ route('docente.informacion', app()->make('App\Http\Controllers\DocenteController')->generarHash($docente->dni_docente)) }}" class="btn btn-sm btn-primary" id="infoLink">
                                    {{ __('Informacion') }}
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            </div>

                            <div class="col">
                                <button class="btn btn-sm btn-info mt-2" onclick="copyToClipboard()">
                                    <i class="fa fa-fw fa-copy"></i>
                                </button>
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


                <!-- Striped Rows ETA -->
                <div class="card">
                    <h5 class="card-header">Asistencia</h5>
                    <div class="demo-inline-spacing mb-2 mx-3">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#crear"
                        >
                            Nuevo
                        </button>
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
                                    <td><p STYLE="display: none">{{ $asist->id_asistencia }}</p>Asistencia</td>
                                    <td>{{ $asist->valor_asistencia }}</td>
                                    <td>{{ $asist->hora }}</td>
                                    <td>{{ $asist->fecha }}</td>
                                    <td>
                                        <form action="{{ route('nota_eta.destroy', $asist->id_asistencia) }}" method="POST">
                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $asist->id_asistencia }}"
                                                    data-valor="{{ $asist->valor_asistencia }}" data-docente="{{ $asist->docente_dni }}" data-hora="{{$asist->hora}}"
                                                    data-fecha="{{ $asist->fecha }}">
                                                {{ __('Edit') }}
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
                <!--/ Striped Rows ETA -->

                <!-- Small Modal Editar-->
                <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel2">Editar Asistencia </h6>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-editar"  method="post" >
                                    @method('PUT')
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">Asistencia</legend>

                                        <div class="col mb-0">
                                            <input type="hidden" id="txt-id" class="form-control" name="id" required readonly/>
                                        </div>

                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Asistencia</label>
                                            <select class="form-select" id="txt-valor" aria-label="Default select example" name="valor" >
                                                <option value="asistencia"> Asistió </option>
                                                <option value="inasistencia"> No asistió </option>
                                                <option value="tardanza"> Tardanza</option>
                                            </select>
                                        </div>

                                        <div class="col mb-0">
                                            <input type="hidden"  class="form-control" placeholder="DNI"  name="dni_docente" value="{{$docente -> dni_docente}}" required readonly/>
                                        </div>

                                        <div class="col mb-0">
                                            <label for="dobLarge" class="form-label">Hora</label>
                                            <input type="time" id="txt-hora" class="form-control"  name="hora"  required/>
                                        </div>

                                        <div class="col mb-0">
                                            <label for="dobLarge" class="form-label">Fecha</label>
                                            <input type="date" id="txt-fecha" class="form-control"  name="fecha" required/>
                                        </div>
                                    </fieldset>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- / Small Modal Editar-->

                <!-- Small Modal  Crear  -->
                <div class="modal fade" id="crear" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel2">Registrar Asistencia </h6>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-crear" action="{{ route('asistencia.store') }}"  method="post" >
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">Asistencia</legend>


                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Asistencia</label>
                                            <select class="form-select" id="txt-valor" aria-label="Default select example" name="valor" >
                                                <option value="asistencia"> Asistió </option>
                                                <option value="inasistencia"> No asistió </option>
                                                <option value="tardanza"> Tardanza</option>
                                            </select>
                                        </div>

                                        <div class="col mb-0 ">
                                            <input type="hidden" class="form-control" placeholder="DNI"  name="dni_docente" value="{{ $docente->dni_docente }}"  required readonly/>
                                        </div>

                                        <div class="col mb-0">
                                            <label for="dobLarge" class="form-label">Hora</label>
                                            <input type="time" id="txt-hora" class="form-control"  name="hora" />
                                        </div>

                                        <div class="col mb-0">
                                            <label for="dobLarge" class="form-label">Fecha</label>
                                            <input type="date" id="dobLarge" class="form-control"  name="fecha" required/>
                                        </div>

                                    </fieldset>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- / Small Modal Crear -->







            </div>
        </div>
        <!--/ Layout Demo -->
    </div>
    <!-- / Content -->


    <!-- Scripts -->

    @push('scripts')
        <!-- ChartMin -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    @endpush

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
            let docente_id_docente = $(this).data('dni_docente');
            let hora = $(this).data('hora');
            let fecha = $(this).data('fecha');

            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-id").val(id_asistencia);
            $("#txt-valor").val(valor_asistencia);
            $("#txt-docente").val(docente_id_docente);
            $("#txt-hora").val(hora);
            $("#txt-fecha").val(fecha);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('asistencia.update', ':id') }}";
            url = url.replace(':id', id_asistencia);
            $('#form-editar').attr('action', url);
        })
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

    <script>
        async function copyToClipboard() {
            try {
                await navigator.clipboard.writeText(document.getElementById('infoLink').href);
                swal("¡Hecho!", "Enlace copiado al portapapeles", "success");
            } catch (err) {
                console.error('Error al copiar el enlace: ', err);
            }
        }
    </script>
    <!-- / Scripts -->


@endsection
