@extends('layout.app')

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
                                    <p class="font-weight-bold">Datos Completos:</p>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-primary mb-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCenter"
                                    >
                                        Ver Datos
                                    </button>
                                </div>

                                <div class="col">
                                    <p class="card-text">Tabla de asistencia:</p>
                                    <a href="{{ route('estudiante.asistencia', $estudiante->dni_estudiante) }}" class="btn btn-sm btn-primary">
                                        {{ __('Asistencias') }}
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-body">


                                <h5 class="card-title">Informacion para Padres</h5>

                                <div class="col">
                                    <a href="{{ route('estudiante.informacion', app()->make('App\Http\Controllers\EstudianteController')->generarHash($estudiante->dni_estudiante)) }}" class="btn btn-sm btn-primary" id="infoLink">
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
                        <h5 class="card-header">Notas ETA</h5>
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
                                        <td>
                                            <form action="{{ route('nota_eta.destroy', $nota_eta->id_nota_eta) }}" method="POST">
                                                <button type="button" class="btn btn-sm btn-success btn-editarETA" data-bs-toggle="modal" data-bs-target="#editarETA" data-id="{{ $nota_eta->id_nota_eta }}"
                                                        data-nota="{{ $nota_eta->nota }}" data-fecha="{{ $nota_eta->fecha }}" data-id_estudiante="{{ $nota_eta->estudiante_dni_estudiante }}">
                                                    {{ __('Edit') }}
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </button>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
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
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#crearFast"
                            >
                                Nuevo
                            </button>
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
                                            <form action="{{ route('nota_fast.destroy', $nota->id_nota_fast) }}" method="POST">
                                                <button type="button" class="btn btn-sm btn-success btn-editarFast" data-bs-toggle="modal" data-bs-target="#editarETA" data-id="{{ $nota->id_nota_fast }}"
                                                        data-nota="{{ $nota->nota }}" data-fecha="{{ $nota->fecha }}" data-id_estudiante="{{ $nota->estudiante_dni_estudiante }}">
                                                    {{ __('Edit') }}
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </button>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
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
                                        @method('PUT')
                                        @csrf
                                        <fieldset>
                                            <legend  style="text-align: center">ETA</legend>

                                            <div class="col mb-0">
                                                <label for="nameLarge" class="form-label">Nota</label>
                                                <input type="text" id="txt-notaE" class="form-control" placeholder="Nota" name="nota" required/>
                                            </div>

                                            <div class="col mb-0">
                                                <input type="hidden" id="txt-dni_estudiante" class="form-control" placeholder="DNI"  name="dni_estudiante" value="{{$estudiante->dni_estudiante}}" required readonly/>
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
                                                <input type="date" id="dobLarge2" class="form-control"  name="fecha" required/>
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



                    <!-- Modal Datos -->
                    <div class="col-lg-4 col-md-6">
                        <div class="mt-3">

                            <!-- Modal -->
                            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">Datos Del Estudiante</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <p>{{$estudiante->nombre}}</p>

                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Apellido</label>
                                                       <p>{{$estudiante->apellidos}}</p>

                                                    </div>

                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">DNI</label>
                                                        <p>{{$estudiante->dni_estudiante}}</p>

                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Celular</label>
                                                        <p>{{$estudiante->n_celular}}</p>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Direccion</label>
                                                        <p>{{$estudiante->direccion}}</p>
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Referencia</label>
                                                        <p>{{$estudiante->referencia}}</p>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Datos Extras -->
                                            <div class="accordion" id="studentAccordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="extraDataHeading">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#extraData" aria-expanded="false" aria-controls="extraData">
                                                            Datos Extra
                                                        </button>
                                                    </h2>

                                                    <div id="extraData" class="accordion-collapse collapse" aria-labelledby="extraDataHeading" data-bs-parent="#studentAccordion">
                                                        <div class="accordion-body">

                                                            <fieldset>
                                                                <legend class="mt-1" style="text-align: center">Datos Extra</legend>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Colegio</label>
                                                                        <p>{{$estudiante->colegio}}</p>
                                                                    </div>

                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Celular Apoderado</label>
                                                                        <p>{{$estudiante->celular_apoderado}}</p>
                                                                    </div>

                                                                </div>

                                                                <div class="row g-2">

                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Sede</label>
                                                                        <p>{{$estudiante->sede}}</p>
                                                                    </div>



                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Observacion</label>
                                                                        <p>{{$estudiante->observacion}}</p>
                                                                    </div>
                                                                </div>


                                                            </fieldset>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="paymentInfoHeading">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paymentInfo" aria-expanded="false" aria-controls="paymentInfo">
                                                            Información de Pago
                                                        </button>
                                                    </h2>
                                                    <div id="paymentInfo" class="accordion-collapse collapse" aria-labelledby="paymentInfoHeading" data-bs-parent="#studentAccordion2">
                                                        <div class="accordion-body">
                                                            <fieldset>
                                                                <legend class="mt-1" style="text-align: center">Información de pago</legend>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Estado de Pago</label>
                                                                        <p>{{$estudiante->estado_de_pago}}</p>
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Pago</label>
                                                                        <p>{{$estudiante->pago}}</p>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="paymentInfoHeading">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#carerra" aria-expanded="false" aria-controls="carerra">
                                                            Datos de Carrera
                                                        </button>
                                                    </h2>
                                                    <div id="carerra" class="accordion-collapse collapse" aria-labelledby="paymentInfoHeading" data-bs-parent="#studentAccordion">
                                                        <div class="accordion-body">
                                                            <fieldset>
                                                                <legend  style="text-align: center">Datos Carrera</legend>
                                                                <div class="row g-2">

                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Area</label>
                                                                        <p>{{$estudiante->area_academica ->nombre_area ?? 'N/A'}}</p>
                                                                    </div>

                                                                    <div class="col mb-0">
                                                                        <label for="nameLarge" class="form-label">Carrera</label>
                                                                        <p>{{$estudiante->carrera ->nombre_carrera ?? 'N/A'}}</p>

                                                                    </div>

                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Ciclo</label>
                                                                        <p>{{$estudiante->ciclo ->nombre_ciclo ?? 'N/A'}}</p>

                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Especialidad</label>
                                                                        <p>{{$estudiante->especialidad}}</p>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


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

            <!-- Script para obtener la fecha actual -->

            document.addEventListener("DOMContentLoaded", function() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //Enero es 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById('dobLarge2').value = today;
            });


        </script>

        <script>

            $(document).on("click",".btn-editarFast",function(){
                let id_nota_fast = $(this).data('id');
                let nota = $(this).data('nota');
                let fecha = $(this).data('fecha');
                let estudiante_dni = $(this).data('dni_estudiante');

                $("#txt-id").val(id_nota_fast);
                $("#txt-nota").val(nota);
                $("#txt-fecha").val(fecha);


                let url = "{{ route('nota_fast.update', ':id') }}";
                url = url.replace(':id', id_nota_fast);
                $('#form-editar').attr('action', url);
            })

        </script>


        <script>

            $(document).on("click",".btn-editarETA",function(){
                let id_nota_eta = $(this).data('id');
                let nota = $(this).data('nota');
                let fecha = $(this).data('fecha');
                let estudiante_dni = $(this).data('dni_estudiante');

                $("#txt-idE").val(id_nota_eta);
                $("#txt-notaE").val(nota);
                $("#txt-fechaE").val(fecha);


                let url = "{{ route('nota_eta.update', ':id') }}";
                url = url.replace(':id', id_nota_eta);
                $('#form-editarETA').attr('action', url);
            })

        </script>

        <!-- sccript para copar enlae -->

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
