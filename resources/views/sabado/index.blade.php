@extends('layout.app')

@section('content')



    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sabado /</span> Registro</h4>

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
                            @forelse($sabados as $sabado)
                                <tr>
                                    <td>{{ $sabado -> id_sabado }}</td>
                                    <td >{{ $sabado -> fecha }} </td>
                                    <td>
                                        <form action="{{ route('sabado.destroy',$sabado->id_sabado) }}" method="POST">

                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $sabado->id_sabado }}" data-fecha="{{ $sabado->fecha }}">
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
                                    <td colspan="15">No hay registros.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Sabado</h5>
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


                                                    <input type="hidden" id="txt-id" class="form-control" placeholder="Nombre" name="id" required/>


                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Fecha</label>
                                                        <input type="date" id="txt-fecha" class="form-control" placeholder="Nombre" name="fecha" required/>
                                                    </div>
                                                   
                                                </div>
                                            </fieldset>
                                            <div class="modal-footer mt-1">
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
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Sabado</h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-crear" action="{{ route('sabado.store') }}"  method="post" >
                                            @csrf

                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Fecha</label>
                                                        <input type="date"  class="form-control" name="fecha" placeholder="Nombre" required
                                                                />
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

    @if(session('count') >= 6)
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Se ha alcanzado el límite de 6 registros!',
        })
        </script>
    @endif


    <script>
        //asignar evento click a todos los botones con nombre de clase "btn-editar"
        //Para este caso usaremos JQUERY
        $(document).on("click",".btn-editar",function(){
            //variables
            let id_sabado = $(this).data('id');
            let fecha = $(this).data('fecha');


            $("#txt-id").val(id_sabado);
            $("#txt-fecha").val(fecha);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('sabado.update', ':id') }}";
            url = url.replace(':id', id_sabado);
            $('#form-editar').attr('action', url);
        })
    </script>

@endsection





