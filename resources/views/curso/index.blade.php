@extends('layout.app')

@section('content')



    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Curso /</span> Registro</h4>

                <div class="filas mt-2 ml-5">
                    <span id="contador-filas"></span>
                </div>

                <div class="demo-inline-spacing mb-2">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#largeModal"
                    >
                        Nuevo
                    </button>
                </div>

                <div class="col-lg-3 mb-2 ">
                    <input type="text" class="form-control"  id="search2" placeholder="Ingrese dato a buscar">
                </div>

                <!-- Striped Rows -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped" id="mytable2">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Docente</th>
                                <th>Ciclo</th>
                                <th>Area</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($cursos as $curso)
                                <tr>
                                    <td> {{ $curso ->id_curso}} </td>
                                    <td> {{ $curso ->nombre_curso }} </td>

                                    <td>{{ $curso->docente->nombre_docente ?? 'N/A' }} </td>
                                    <td>{{ $curso->ciclo->nombre_ciclo ?? 'N/A' }} </td>
                                    <td>
                                        @foreach($curso->area_academica as $area_academica)
                                            {{ $area_academica->nombre_area ?? 'N/A' }}
                                        @endforeach
                                    </td>

                                    <td>
                                        <form action="{{ route('curso.destroy',$curso->id_curso) }}" method="POST">

                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $curso->id_curso}}"
                                                    data-nombre="{{ $curso->nombre_curso}}" data-docente="{{ $curso->docente_dni_docente}}" data-ciclo="{{ $curso->ciclo_id_ciclo }}" data-area_academica ="{{$curso->area_academica_id_area}}">
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
                                    <td colspan="15">No hay cursos.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $cursos->links() }}

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Curso</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-editar" action="{{ route('curso.update', $cursos) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text" id="txt-nombre" class="form-control" placeholder="Nombre" name="nombre" required/>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Docente</label>
                                                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="docente" required>
                                                            @foreach($docentes as $docente)
                                                                <option value="{{ $docente->dni_docente }}">{{ $docente->nombre_docente }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Ciclo</label>
                                                        <input type="text" id="txt-dni_docente" class="form-control" placeholder="DNI" name="dni_docente"/>
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Area</label>
                                                        <input type="text" id="txt-celular" class="form-control" name="celular" placeholder="Ingresar Celular" />
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <!-- Datos Extras -->

                                            <fieldset>
                                                <legend class="mt-1" style="text-align: center">Horario</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Horario Inicial</label>
                                                        <input type="time" id="txt-horario_inicio" class="form-control" name="horario_inicio" placeholder="horario_inicio"/>
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Horario Final</label>
                                                        <input type="time" id="txt-horario_final" class="form-control" name="horario_final" placeholder="horario_final" required/>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend class="mt-1" style="text-align: center">Puntaje</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Rendimiento</label>
                                                        <input type="text" id="txt-rendimiento" class="form-control" placeholder="Rendimiento" name="rendimiento" readonly/>
                                                    </div>
                                                    <div class="col mb-0">

                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="modal-footer mt-1   ">
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

                        <!--    Modal Crear -->
                        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Curso</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-crear" action="{{ route('curso.store') }}"  method="post" >
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text"  class="form-control" name="nombre" placeholder="Nombre" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)" />
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Docente</label>
                                                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="docente" required>
                                                            @foreach($docentes as $docente)
                                                                <option value="{{ $docente->dni_docente }}">{{ $docente->nombre_docente }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Ciclo</label>
                                                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="ciclo" required>
                                                            @foreach($ciclos as $ciclo)
                                                                <option value="{{ $ciclo->id_ciclo }}">{{ $ciclo->nombre_ciclo }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Area</label>
                                                        <div>
                                                            @foreach($area_academicas as $area_academica)
                                                                <div class="form-check-label ml-3">
                                                                    <input class="form-check-input" type="checkbox" name="area_academica[]" value="{{ $area_academica->id_area}}" id="area_academica-{{ $area_academica->id_area }}">
                                                                    <label class="form-check-label" for="area_academica-{{ $area_academica->id_area }}">{{ $area_academica->nombre_area }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>



                                            <div class="modal-footer mt-1   ">
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


                    </div>
                </div>
                <!--/ Striped Rows -->

            </div>
        </div>
        <!--/ Layout Demo -->
    </div>
    <!-- / Content -->

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $errors->first() }}',
            })
        </script>
    @endif

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
            let nombre_docente = $(this).data('nombre');
            let apellido_docente = $(this).data('apellido');
            let dni_docente = $(this).data('dni_docente');
            let celular = $(this).data('celular');
            let rendimiento = $(this).data('rendimiento');
            let horario_inicio = $(this).data('horario_inicio')
            let horario_final = $(this).data('horario_final');



            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-nombre").val(nombre_docente);
            $("#txt-apellido").val(apellido_docente);
            $("#txt-dni_docente").val(dni_docente);
            $("#txt-celular").val(celular);
            $("#txt-direccion").val(rendimiento);
            $("#txt-horario_inicio").val(horario_inicio);
            $("#txt-horario_final").val(horario_final);




            // Actualizar la acción del formulario en el modal
            let url = "{{ route('docente.update', ':dni_docente') }}";
            url = url.replace(':dni_docente', dni_docente);
            $('#form-editar').attr('action', url);
        })
    </script>



    <script>
        // Write on keyup event of keyword input element
        $(document).ready(function(){
            $("#search2").keyup(function(){
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#mytable2 tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
    </script>


@endsection



