@extends('layout.app')

@section('content')


    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Horario /</span> Registro</h4>

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

                <!-- Striped Rows -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped" id="mytable2">
                            <thead>
                            <tr>
                                <th>Turno</th>
                                <th>Horario Inicial</th>
                                <th>Horario Final</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($horarios as $horario)
                                <tr>

                                    <td> {{ $horario ->nombre }} </td>
                                    <td> {{ $horario->h_inicio}} </td>
                                    <td> {{ $horario->h_final }} </td>

                                    <td>
                                        <form action="{{ route('ciclo.destroy',$horario->id) }}" method="POST">

                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $horario->id }}"
                                                    data-nombre ="{{$horario->nombre}}" data-inicio="{{$horario->h_inicio}}" data-final="{{$horario->h_final}}">
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
                                    <td colspan="15">No hay Horarios.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Horario</h5>
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
                                                        <label for="nameLarge" class="form-label">ID</label>
                                                        <input type="text" id="txt-id" class="form-control" placeholder="Nombre" name="id" required readonly
                                                                />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text" id="txt-nombre" class="form-control" placeholder="Nombre" name="nombre" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32 || event.charCode == 241 || event.charCode == 209)" />
                                                    </div>

                                                </div>
                                                <div class="row g-2">

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Inicio</label>
                                                        <input type="time" id="txt-inicio" class="form-control"  name="inicio"/>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Fin</label>
                                                        <input type="time" id="txt-final" class="form-control"  name="final"/>
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
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Horario</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-crear" action="{{ route('horario.store') }}"  method="post" >
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text"  class="form-control" placeholder="Nombre" name="nombre" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32 || event.charCode == 241 || event.charCode == 209)"
                                                        />
                                                    </div>

                                                </div>
                                                <div class="row g-2">

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Horario Inicial</label>
                                                        <input type="time"  class="form-control"  name="inicio"/>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Horario Final</label>
                                                        <input type="time"  class="form-control"  name="final"/>
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
        //asignar evento click a todos los botones con nombre de clase "btn-editar"
        //Para este caso usaremos JQUERY
        $(document).on("click",".btn-editar",function(){
            //variables
            let id = $(this).data('id')
            let nombre = $(this).data('nombre');
            let h_inicio = $(this).data('inicio');
            let h_final = $(this).data('final');

            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-id").val(id);
            $("#txt-nombre").val(nombre);
            $("#txt-inicio").val(h_inicio);
            $("#txt-final").val(h_final);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('horario.update', ':id') }}";
            url = url.replace(':id', id);
            $('#form-editar').attr('action', url);
        })
    </script>




@endsection





