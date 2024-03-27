@extends('layout.app2')

@section('content')

    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Estudiante /</span> Datos Generales</h4>
                <!-- Card Groups -->
                <div class="card-group mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos Generales</h5>

                            <div class="col">
                                <p class="font-weight-bold">Nombre:</p>
                                <p >{{ $estudiante->nombre }} {{ $estudiante->apellidos }}</p>
                            </div>
                            <div class="col">
                                <P class="font-weight-bold">DNI:</P>
                                <p >{{ $estudiante->dni_estudiante }}</p>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Sede:</p>
                                <p>{{ $estudiante->sede }}</p>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Area:</p>
                                <p>{{ $estudiante->area_academica ? $estudiante->area_academica->nombre_area: ''}}</p>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos</h5>
                            <div class="col">
                                <p class="card-text">Promedio:</p>
                                <p>{{ \Illuminate\Support\Str::limit($promedio, 5) }}</p>

                            </div>

                            <div class="col">
                                <p class="card-text">Conducta:</p>
                                <p >{{ $estudiante->conducta }}</p>
                            </div>

                            <div class="col">
                                <p class="font-weight-bold">Observacion:</p>
                                <p>{{$estudiante->observacion}}</p>
                            </div>
                            <div class="col">
                                <p class="card-text">Tabla de asistencia:</p>
                                <a href="{{ route('estudiante.asis_info',app()->make('App\Http\Controllers\EstudianteController')->generarHash($estudiante->dni_estudiante)) }}" class="btn btn-sm btn-primary">
                                    {{ __('Asistencias') }}
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
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
                    <h5 class="card-header">Notas ETA</h5>
                    <div class="demo-inline-spacing mb-2 mx-3">

                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nota</th>
                                <th>Fecha</th>

                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($estudiante->nota_eta as $nota_eta)
                                <tr>
                                    <td ><p STYLE="display: none">{{ $nota_eta->id_nota_eta }}</p>ETA</td>
                                    <td>{{ $nota_eta->nota }}</td>
                                    <td >{{ $nota_eta->fecha }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
                <!--/ Striped Rows ETA -->

                <!-- Striped Rows FAST-TEST -->
                <div class="card mt-4">
                    <h5 class="card-header">Notas FAST-TEST</h5>
                    <div class="demo-inline-spacing mb-2 mx-3">
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($nota_fast as $nota)
                                <tr>
                                    <td><p STYLE="display: none">{{ $nota->id_nota_fast }}</p>FAST</td>
                                    <td>{{ $nota->nota }}</td>
                                    <td>{{ $nota->fecha }}</td>
                                    <td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $nota_fast->links() }}

                    </div>
                </div>
                <!--/ Striped Rows FAST-TEST-->

                <!-- Small Modal Editar Fast-Test-->
                <div class="modal fade" id="editarFast" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Registrar Nota </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-editar"   method="post" >
                                    @method('PUT')
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">FAST-TEST</legend>

                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Nota</label>
                                            <input type="text" id="nameLarge" class="form-control" placeholder="Nota" name="nota" required/>
                                        </div>

                                        <div class="col mb-0">
                                            <input type="hidden" id="emailLarge" class="form-control" placeholder="DNI"  name="dni_estudiante" value="{{$estudiante->dni_estudiante}}" required readonly/>
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
                <!-- / Small Modal Editar Fast-Test-->

                <!-- Small Modal Editar ETA-->
                <div class="modal fade" id="editarETA" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Registrar Nota </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-editarETA"  method="post" >
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">ETA</legend>

                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Nota</label>
                                            <input type="text" id="nameLarge" class="form-control" placeholder="Nota" name="nota" required/>
                                        </div>

                                        <div class="col mb-0">
                                            <input type="hidden" id="emailLarge" class="form-control" placeholder="DNI"  name="dni_estudiante" value="{{$estudiante->dni_estudiante}}" required readonly/>
                                        </div>

                                        <div class="col mb-0">
                                            <label for="dobLarge" class="form-label">Fecha</label>
                                            <input type="date" id="txt-fechaE" class="form-control"  name="fecha" required/>
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
                <!-- / Small Modal Editar ETA-->

                <!-- Small Modal  Crear ETA -->
                <div class="modal fade" id="crear" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Registrar Nota </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-crear" action="{{ route('nota_eta.store') }}"  method="post" >
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">ETA</legend>

                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Nota</label>
                                            <input type="text" id="nameLarge" class="form-control" placeholder="Nota" name="nota" required/>
                                        </div>

                                        <div class="col mb-0">
                                            <input type="hidden" id="emailLarge" class="form-control" placeholder="DNI"  name="dni_estudiante" value="{{$estudiante->dni_estudiante}}" required readonly/>
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
                <!-- / Small Modal Crear ETA-->

                <!-- Small Modal  Crear Fast-Test -->
                <div class="modal fade" id="crearFast" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Registrar Nota </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-crear" action="{{ route('nota_fast.store') }}"  method="post" >
                                    @csrf
                                    <fieldset>
                                        <legend  style="text-align: center">Fast-Test</legend>

                                        <div class="col mb-0">
                                            <label for="nameLarge" class="form-label">Nota</label>
                                            <input type="text" id="nameLarge" class="form-control" placeholder="Nota" name="nota" required/>
                                        </div>

                                        <div class="col mb-0">
                                            <input type="hidden" id="emailLarge" class="form-control" placeholder="DNI"  name="dni_estudiante" value="{{$estudiante->dni_estudiante}}" required readonly/>
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
                <!-- / Small Modal Crear Fast-Test-->



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





