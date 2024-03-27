@extends('layout.app')

@section('content')



    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Area /</span> Registro</h4>

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
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($area_academicas as $area_academica)
                                <tr>
                                    <td>{{$area_academica -> id_area}}</td>
                                    <td >{{ $area_academica ->nombre_area }} </td>
                                    <td>
                                        <form action="{{ route('area_academica.destroy',$area_academica->id_area) }}" method="POST">

                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $area_academica->id_area }}" data-nombre="{{ $area_academica->nombre_area }}">
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
                                    <td colspan="15">No hay areas.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Area</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-editar"  method="post">
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
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Area</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-crear" action="{{ route('area_academica.store') }}"  method="post" >
                                            @csrf

                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text"  class="form-control" name="nombre" placeholder="Nombre" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)" />
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
            let id_area = $(this).data('id');
            let nombre_area = $(this).data('nombre');
            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-id").val(id_area);
            $("#txt-nombre").val(nombre_area);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('area_academica.update', ':id') }}";
            url = url.replace(':id', id_area);
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




