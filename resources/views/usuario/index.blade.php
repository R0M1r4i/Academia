@extends('layout.app')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* HTML: <div class="loader"></div> */
        .loader {
            width: 90px;
            height: 24px;
            padding: 2px 0;
            box-sizing: border-box;
            display: flex;
            animation: l5-0 3s infinite steps(6);
            background:
                linear-gradient(#000 0 0) 0 0/0% 100% no-repeat,
                radial-gradient(circle 3px,#eeee89 90%,#0000) 0 0/20% 100%
                #000;
            overflow: hidden;
        }
        .loader::before {
            content: "";
            width: 20px;
            transform: translate(-100%);
            border-radius: 50%;
            background: #ffff2d;
            animation:
                l5-1 .25s .153s infinite steps(5) alternate,
                l5-2  3s        infinite linear;
        }
        @keyframes l5-1{
            0% {clip-path: polygon(50% 50%,100%   0,100% 0,0 0,0 100%,100% 100%,100% 100%)}
            100% {clip-path: polygon(50% 50%,100% 65%,100% 0,0 0,0 100%,100% 100%,100%  35%)}
        }
        @keyframes l5-2{
            100% {transform: translate(90px)}
        }
        @keyframes l5-0{
            100% {background-size:120% 100%,20% 100%}
        }
    </style>




    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuario /</span> Registro</h4>

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



                    <div class="col">
                        <button id="enviarMensaje" class="btn btn-sm btn-success">
                            {{ __('Enviar Mensaje') }}
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>

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
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Rol</th>

                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($usuario as $usuario)
                                <tr>

                                    <td> {{$usuario -> nombre }} </td>
                                    <td> {{$usuario -> apellido }}</td>
                                    <td> {{$usuario -> usuario}}</td>
                                    <td> {{$usuario -> rol  }} </td>


                                    <td>
                                        <form action="{{ route('usuario.destroy',$usuario->id_usuario) }}" method="POST">

                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar"  data-id_usuario ="{{ $usuario->id_usuario }}"
                                                    data-nombre="{{ $usuario->nombre }}" data-apellido="{{$usuario->apellido}}" data-usuario="{{$usuario->usuario}}" data-rol="{{$usuario->rol}}">
                                                {{ __('Edit') }}
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Usuario</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-editar" method="post">
                                            @method('PUT')
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <input type="hidden" id="txt-id_usuario" class="form-control" placeholder="Nombre" name="id_usuario" required/>
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text" id="txt-nombre" class="form-control" placeholder="Nombre" name="nombre" required/>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Apellido</label>
                                                        <input type="text" id="txt-apellido" class="form-control" placeholder="Apellido" name="apellido" required/>
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Usuario</label>
                                                        <input type="text" id="txt-usuario" class="form-control"  placeholder="DNI" name="usuario" required/>
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Contraseña</label>
                                                        <input type="text" id="txt-contraseña" class="form-control"  name="contraseña" placeholder="contraseña"/>
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">ROL</label>
                                                        <select class="form-select" id="txt-rol" aria-label="Default select example" name="rol" required>
                                                            <option value="usuario">Usuario</option>
                                                            <option value="superusuario">SuperUsuario</option>

                                                        </select>
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
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Usuario</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-crear" action="{{ route('usuario.store') }}"  method="post" >
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text"  class="form-control" placeholder="Nombre" name="nombre" required/>
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Apellido</label>
                                                        <input type="text"  class="form-control" placeholder="Apellido" name="apellido" required/>

                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Usuario</label>
                                                        <input type="text"  class="form-control" placeholder="usuario" name="usuario" required/>
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Contraseña</label>
                                                        <input type="text"  class="form-control" name="contraseña" placeholder="Contraseña" required />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">ROL</label>
                                                        <select class="form-select"  aria-label="Default select example" name="rol" required>
                                                            <option value="usuario">Usuario</option>

                                                        </select>
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
        $('#enviarMensaje').click(function(e){
            e.preventDefault();
            Swal.fire({
                html: '<div class="loader"></div>', // use custom loading spinner
                showConfirmButton: false,
                allowOutsideClick: false,
                width: 'auto',
                padding: '3em',
            });
            $.ajax({
                url: '{{url('/envia')}}',
                type: 'GET',
                success: function(response) {
                    Swal.close();
                    if (response.errores.length > 0) {
                        Swal.fire(
                            'Error',
                            'No se pudieron enviar los mensajes a los siguientes números: ' + response.errores.join(', '),
                            'error'
                        )
                    } else {
                        Swal.fire(
                            '¡Enviado!',
                            'Los Mensajes fueron Enviados.',
                            'success'
                        )
                    }
                }
            });
        });




    </script>


    <script>
        //asignar evento click a todos los botones con nombre de clase "btn-editar"
        //Para este caso usaremos JQUERY
        $(document).on("click",".btn-editar",function(){
            //variables
            let id_usuario = $(this).data('id_usuario');
            let nombre = $(this).data('nombre');
            let apellido = $(this).data('apellido');
            let usuario = $(this).data('usuario');
            let contraseña = $(this).data('contraseña');
            let rol = $(this).data('rol')

            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-id_usuario").val(id_usuario);
            $("#txt-nombre").val(nombre);
            $("#txt-apellido").val(apellido);
            $("#txt-usuario").val(usuario);
            $("#txt-contraseña").val(contraseña);
            $("#txt-rol").val(rol);

            // Actualizar la acción del formulario en el modal
            let url = "{{ route('usuario.update', ':id_usuario') }}";
            url = url.replace(':id', id_usuario);
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




