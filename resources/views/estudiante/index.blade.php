@extends('layout.app')

@section('content')

    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">

                <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Estudiante /</span> Registro</h4>

                <div class="fw-bold ">
                    <p style="display: inline">Contador de registros: </p>
                    <span id="contador"></span>
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

                <div class="col-lg-3 mb-3 ">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Buscar estudiante por DNI">
                        <div class="input-group-append">

                            <button id="search-button" class="btn btn-info ms-2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>

                            <button id="clear-button" class="btn btn-warning ms-2">
                                <i class="fa-solid fa-broom"></i>
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped" id="mytable2">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Celular</th>
                                <th style="display: none">Direccion</th>
                                <th style="display: none;">Referencia</th>
                                <th style="display: none;">Colegio</th>
                                <th style="display: none;">Sede</th>
                                <th>Celular Apoderado</th>
                                <th style="display: none">Estado de Pago</th>
                                <th style="display: none;">Pago</th>
                                <th style="display: none;">Carrrea</th>
                                <th style="display: none;">Especialidad</th>
                                <th style="display: none">Area</th>
                                <th style="display: none">Ciclo</th>
                                <th style="display: none;">Conducta</th>
                                <th style="display: none;">Observacion</th>
                                <th style="display: none;">Horario</th>
                                <th style="display: none;">Especialidad </th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($estudiantes as $estudiante)
                                <tr>
                                    <td> {{ $estudiante ->nombre }} </td>
                                    <td> {{ $estudiante -> apellidos }}</td>
                                    <td> {{ $estudiante -> dni_estudiante }}</td>
                                    <td> {{ $estudiante -> n_celular }}</td>
                                    <td style="display: none"> {{ $estudiante ->direccion }}</td>
                                    <td style="display: none"> {{$estudiante ->referencia}}</td>
                                    <td style="display: none"> {{ $estudiante -> colegio}}</td>
                                    <td style="display: none"> {{ $estudiante ->sede }} </td>
                                    <td> {{ $estudiante -> celular_apoderado }} </td>
                                    <td style="display: none"> {{ $estudiante -> estado_de_pago }} </td>
                                    <td style="display: none"> {{ $estudiante -> pago }} </td>
                                    <td style="display: none"> {{ $estudiante->carrera->nombre_carrera ?? 'N/A' }}</td>
                                    <td style="display: none"> {{$estudiante->especialidad}} </td>
                                    <td style="display: none"> {{ $estudiante->area_academica->nombre_area ?? 'N/A' }}</td>
                                    <td style="display: none"> {{ $estudiante -> ciclo -> nombre_ciclo ?? 'N/A' }}</td>
                                    <td style="display: none">{{ $estudiante -> conducta }}</td>
                                    <td style="display: none">{{ $estudiante -> observacion }}</td>
                                    <td style="display: none"> {{$estudiante -> horario -> nombre ?? 'N/A' }}</td>
                                    <td style="display: none">{{$estudiante -> especialidad }}</td>


                                    <td>
                                        <form action="{{ route('estudiante.destroy',$estudiante->dni_estudiante) }}" method="POST">
                                            <a href="{{ route('estudiante.show', $estudiante->dni_estudiante) }}" class="btn btn-sm btn-primary">
                                                {{ __() }}
                                                <i class="fa fa-fw fa-file-lines"></i>
                                            </a>



                                            <button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="{{ $estudiante->id_estudiante }}" data-nombre="{{ $estudiante->nombre}}"
                                                    data-apellido ="{{ $estudiante->apellidos }}" data-dni_estudiante ="{{ $estudiante->dni_estudiante }}" data-celular ="{{ $estudiante->n_celular }}" data-direccion ="{{ $estudiante->direccion }}" data-referencia = "{{$estudiante->referencia}}"
                                                    data-colegio ="{{ $estudiante->colegio}}" data-sede ="{{ $estudiante->sede }}" data-celular-apoderado="{{ $estudiante->celular_apoderado}}" data-estado = "{{$estudiante->estado_de_pago}}"
                                                    data-pago ="{{ $estudiante->pago }}" data-carrera ="{{ $estudiante->carrera_id_carrera }}"    data-area ="{{ $estudiante->area_academica_id_area }}" data-ciclo ="{{$estudiante->ciclo_id_ciclo}}"
                                                    data-conducta ="{{$estudiante -> conducta}}" data-observacion ="{{$estudiante->observacion}}" data-especialidad = "{{$estudiante->especialidad}}" data-horario="{{$estudiante-> horario_id_horario}}" data-foto="{{$estudiante->foto}}" >
                                                {{ __() }}
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>


                                            <a href="{{ url('/pdf/' . $estudiante->dni_estudiante) }}" class="btn btn-sm btn-body">
                                                {{ __() }}
                                                <i class="fa-regular fa-file-pdf fa-lg"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="15">No hay estudiantes.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $estudiantes->links() }}

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editar" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Editar Estudiante</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                    <div class="modal-body">
                                        <form id="form-editar"  method="post" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <fieldset>
                                                <legend  style="text-align: center">Datos Principales</legend>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Nombre</label>
                                                        <input type="text" id="txt-nombre" class="form-control " placeholder="Nombre" name="nombre" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                        />
                                                    </div>

                                                    <div class="col mb-0">
                                                        <label for="nameLarge" class="form-label">Apellido</label>
                                                        <input type="text" id="txt-apellido" class="form-control" placeholder="Apellido" name="apellido" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">DNI</label>
                                                        <input type="text" id="txt-dni_estudiante" class="form-control" placeholder="DNI" name="dni_estudiante" required
                                                               onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="8"
                                                        />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Celular</label>
                                                        <input type="text" id="txt-celular" class="form-control" placeholder="Ingresar Celular" name="celular"
                                                               onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="9"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="emailLarge" class="form-label">Direccion</label>
                                                        <input type="text" id="txt-direccion" class="form-control" placeholder="Direccion"  name="direccion" required
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                        />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="dobLarge" class="form-label">Referencia</label>
                                                        <input type="text" id="txt-referencia" class="form-control" placeholder="Referencia" name="referencia"
                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                        />
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Datos Extras  Acordeon -->

                                            <div class="accordion" id="studentAccordion2">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="extraDataHeading">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#extraData" aria-expanded="false" aria-controls="extraData">
                                                            Datos Extra
                                                        </button>
                                                    </h2>
                                                    <div id="extraData" class="accordion-collapse collapse" aria-labelledby="extraDataHeading" data-bs-parent="#studentAccordion2">
                                                        <div class="accordion-body">
                                                            <fieldset>
                                                                <legend class="mt-1" style="text-align: center">Datos Extra</legend>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Colegio</label>
                                                                        <input type="text" id="txt-colegio" class="form-control" placeholder="Colegio" name="colegio"
                                                                               onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                                        />
                                                                    </div>

                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Celular Apoderado</label>
                                                                        <input type="text" id="txt-celularApoderado" class="form-control" placeholder="Celular Apoderado" name="celularApoderado" required maxlength="9"
                                                                               onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                        />
                                                                    </div>



                                                                </div>
                                                                <div class="row g-2">

                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Turno</label>
                                                                        <select class="form-select"  aria-label="Default select example" id="txt-horario" name="horario" required>
                                                                            @foreach($horarios as $horario)
                                                                                <option value="{{ $horario->id }}">{{ $horario->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Conducta</label>
                                                                        <select class="form-select" id="txt-conducta" aria-label="Default select example" name="conducta" >
                                                                            <option value="Excelete">Excelente</option>
                                                                            <option value="Regular">Regular</option>
                                                                            <option value="Mala">Mala</option>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Sede</label>
                                                                        <select class="form-select" id="txt-sede" aria-label="Default select example" name="sede" >
                                                                            <option selected value="9 de Diciembre">9 de Diciembre</option>
                                                                        </select>
                                                                    </div>


                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Observacion</label>
                                                                        <input type="text" id="txt-observacion" class="form-control" placeholder="Observacion" name="observacion" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                                        />
                                                                    </div>
                                                                </div>

                                                                <div class="col mb-0 mt-2">
                                                                    <label for="emailLarge" class="form-label">Foto del Estudiante</label>

                                                                    <div class="input-group">
                                                                        <input type="file" name="foto" id="img-foto" class="form-control" />
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
                                                    <div id="paymentInfo" class="accordion-collapse collapse" aria-labelledby="paymentInfoHeading" data-bs-parent="#studentAccordion">
                                                        <div class="accordion-body">
                                                            <fieldset>
                                                                <legend class="mt-1" style="text-align: center">Información de pago</legend>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Estado de Pago</label>
                                                                        <select class="form-select" id="txt-estado3" aria-label="Default select example" name="estado" required>
                                                                            <option selected>Seleccionar...</option>
                                                                            <option value="Completo">Pendiente</option>
                                                                            <option value="Pendiente">Completo</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Pago</label>
                                                                        <input type="text" id="txt-pago" class="form-control" placeholder="Pago" name="pago" required
                                                                               onkeypress="return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)"
                                                                        />
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
                                                    <div id="carerra" class="accordion-collapse collapse" aria-labelledby="paymentInfoHeading" data-bs-parent="#studentAccordion2">
                                                        <div class="accordion-body">
                                                            <fieldset>
                                                                <legend  style="text-align: center">Datos Carrera</legend>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="dobLarge" class="form-label">Area</label>
                                                                        <select class="form-select" id="txt-area" aria-label="Default select example" name="area" required>
                                                                            @foreach($area_academicas as $area_academica)
                                                                                <option value="{{ $area_academica->id_area }}">{{ $area_academica->nombre_area }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col mb-0">
                                                                        <label for="nameLarge" class="form-label">Carrera</label>
                                                                        <select class="form-select" id="txt-carrera" aria-label="Default select example" name="carrera" required>
                                                                            @foreach($carreras as $carrera)
                                                                                <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre_carrera }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Ciclo</label>
                                                                        <select class="form-select" id="txt-ciclo" aria-label="Default select example" name="ciclo" required>
                                                                            @foreach($ciclos as $ciclo)
                                                                                <option value="{{ $ciclo->id_ciclo }}">{{ $ciclo->nombre_ciclo }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <div class="col mb-0">
                                                                            <label for="dobLarge" class="form-label">Especialidad</label>
                                                                            <input type="text" id="txt-especialidad" class="form-control" placeholder="Especialidad" name="especialidad" required
                                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                                            />
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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






            <!--Modal Crear -->
                        <div class="modal fade"  id="largeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Registrar Estudiante</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>

                                    <!-- datos principales -->

                                        <div class="modal-body">
                                            <form id="form-crear"  method="POST" action="{{ route('estudiante.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <fieldset>
                                                    <legend  style="text-align: center">Datos Principales</legend>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="nameLarge" class="form-label">Nombre</label>
                                                            <input type="text" id="validationCustom01" class="form-control" name="nombre" placeholder="Nombre" required
                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                            />

                                                        </div>

                                                        <div class="col mb-0">
                                                            <label for="nameLarge" class="form-label">Apellido</label>
                                                            <input type="text" id="nameLarge" class="form-control" placeholder="Apellido" name="apellido" required
                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                            />

                                                        </div>

                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="emailLarge" class="form-label">DNI</label>
                                                            <input type="text" id="txt-dni_docente" class="form-control" placeholder="DNI"  name="dni_estudiante" required  minlength="8" maxlength="8"
                                                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                            />

                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="dobLarge" class="form-label">Celular</label>
                                                            <input type="text" id="dobLarge" class="form-control" placeholder="Ingresar Celular" name="celular" minlength="9" maxlength="9"
                                                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="emailLarge" class="form-label">Direccion</label>
                                                            <input type="text" id="emailLarge" class="form-control" placeholder="Direccion" name="direccion" required
                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                            />
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="dobLarge" class="form-label">Referencia</label>
                                                            <input type="text" id="dobLarge" class="form-control" placeholder="Referencia" name="referencia"
                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"

                                                            />
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
                                                                            <input type="text" id="emailLarge" class="form-control" placeholder="Colegio" name="colegio"
                                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32)"
                                                                            />
                                                                        </div>

                                                                        <div class="col mb-0">
                                                                            <label for="dobLarge" class="form-label">Celular Apoderado</label>
                                                                            <input type="text" id="dobLarge" class="form-control" placeholder="Celular Apoderado" name="celularApoderado" required  minlength="9" maxlength="9"
                                                                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                            />
                                                                        </div>



                                                                    </div>

                                                                    <div class="row g-2">

                                                                        <div class="col mb-0">
                                                                            <label for="emailLarge" class="form-label">Turno</label>
                                                                            <select class="form-select"  aria-label="Default select example" name="horario" required>
                                                                                @foreach($horarios as $horario)
                                                                                    <option value="{{ $horario->id }}">{{ $horario->nombre }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="col mb-0">
                                                                            <label for="emailLarge" class="form-label">Sede</label>
                                                                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="sede" required>
                                                                                <option value="9 de Diciembre">9 de Diciembre</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>


                                                                    <div class="col mb-0">
                                                                        <label for="emailLarge" class="form-label">Observacion</label>
                                                                        <input type="text" id="dobLarge" class="form-control" placeholder="Observacion" name="observacion" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                                        />
                                                                    </div>

                                                                    <div class="col mb-0 mt-2">
                                                                        <label for="emailLarge" class="form-label">Foto del Estudiante</label>
                                                                        <div class="input-group">
                                                                            <input type="file" name="foto" class="form-control" id="img-foto"  required/>
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
                                                                            <select class="form-select"  aria-label="Default select example" name="estado" required>
                                                                                <option selected>Seleccionar...</option>
                                                                                <option value="Completo">Pendiente</option>
                                                                                <option value="Pendiente">Completo</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label for="dobLarge" class="form-label">Pago</label>
                                                                            <input type="text" id="dobLarge" class="form-control" placeholder="Pago" name="pago" required
                                                                                   onkeypress="return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)"
                                                                            />
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
                                                                            <select class="form-select" id="txt-area2" aria-label="Default select example" name="area" required>
                                                                                @foreach($area_academicas as $area_academica)
                                                                                    <option value="{{ $area_academica->id_area }}">{{ $area_academica->nombre_area }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="col mb-0">
                                                                            <label for="nameLarge" class="form-label">Carrera</label>
                                                                            <select class="form-select" id="txt-carrera2" aria-label="Default select example" name="carrera" required>
                                                                                @foreach($carreras as $carrera)
                                                                                    <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre_carrera }}</option>
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
                                                                            <label for="dobLarge" class="form-label">Especialidad</label>
                                                                            <input type="text"  class="form-control" placeholder="Especialidad" name="especialidad" required
                                                                                   onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 32 || event.charCode === 47)"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Carrera -->

                                                <div class="modal-footer mt-1   ">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"
                                                        onclick="limpiarFormulario()"
                                                    >
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"  >Guardar</button>
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
            let nombre = $(this).data('nombre');
            let apellidos = $(this).data('apellido');
            let dni_estudiante = $(this).data('dni_estudiante');
            let n_celular = $(this).data('celular');
            let direccion = $(this).data('direccion');
            let referencia = $(this).data('referencia')
            let colegio = $(this).data('colegio');
            let sede = $(this).data('sede');
            let celular_apoderado = $(this).data('celularApoderado');
            let estado_de_pago = $(this).data('estado');
            let pago = $(this).data('pago');
            let carrera = $(this).data('carrera');
            let especialidad = $(this).data('especialidad');
            let area = $(this).data('area');
            let ciclo = $(this).data('ciclo');
            let conducta = $(this).data('conducta');
            let observacion = $(this).data('observacion');
            let horario = $(this).data('horario');
            let foto = $(this).data('foto');

            //mostrar en los controles los valores de las variables
            //trabajar con el atributo "ID"
            $("#txt-nombre").val(nombre);
            $("#txt-apellido").val(apellidos);
            $("#txt-dni_estudiante").val(dni_estudiante);
            $("#txt-celular").val(n_celular);
            $("#txt-direccion").val(direccion);
            $("#txt-referencia").val(referencia);
            $("#txt-colegio").val(colegio);
            $("#txt-sede").val(sede);
            $("#txt-celularApoderado").val(celular_apoderado);
            $("#txt-estado3").val(estado_de_pago);
            $("#txt-pago").val(pago);
            $("#txt-carrera").val(carrera);
            $("#txt-especialidad").val(especialidad);
            $("#txt-area").val(area);
            $("#txt-ciclo").val(ciclo);
            $("#txt-conducta").val(conducta);
            $("#txt-observacion").val(observacion);
            $("#txt-horario").val(horario);
            // Muestra la foto actual
            $("#current-photo").attr('src', foto);


            // Actualizar la acción del formulario en el modal
            let url = "{{ route('estudiante.update', ':dni_estudiante') }}";
            url = url.replace(':dni_estudiante', dni_estudiante);
            $('#form-editar').attr('action', url);
        })
    </script>

    <script>
        $('#txt-area').change(function() {
            var id_area = $(this).val();
            var url = '{{ route('area_academica.getCarreras', ['id_area' => 'ID_AREA']) }}';
            url = url.replace('ID_AREA', id_area);

            $.get(url, function(data) {
                var select = $('#txt-carrera');
                select.empty();
                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id_carrera + '>' + value.nombre_carrera + '</option>');
                });
            });
        });
    </script>



    <script>
        $(document).on("click",".btn-editar",function(){
            let dni_estudiante = $(this).data('dni_estudiante');
            // Resto del código

            let url = "{{ route('estudiante.update', ':dni_estudiante') }}";
            url = url.replace(':dni_estudiante', dni_estudiante);
            $('#form-editar').attr('action', url);
        })
    </script>

    <script>
        function updateCount() {
            $.get('{{ route('estudiante.countEstudiantes') }}', function(data) {
                // Actualiza tu contador
                $('#contador').text(data);
            });
        }

        // Llama a la función
        setInterval(updateCount, 1000);
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

    <!-- script para select en tiempo Real-->



    <script>
        $('#txt-area2').change(function() {
            var id_area = $(this).val();
            var url = '{{ route('area_academica.getCarreras', ['id_area' => 'ID_AREA']) }}';
            url = url.replace('ID_AREA', id_area);

            $.get(url, function(data) {
                var select = $('#txt-carrera2');
                select.empty();
                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id_carrera + '>' + value.nombre_carrera + '</option>');
                });
            });
        });
    </script>

    <!-- limpiar entradas -->

    <script>
        function limpiarFormulario() {

            $('#form-crear').trigger("reset");

        }
    </script>


    <!-- buscar con ajax -->


    <script>
        $('#search-button').on('click', function() {
            var query = $('#search').val();
            $.ajax({
                url: "/search",
                type: "GET",
                data: { 'query': query },
                success: function(data) {
                    var rows = '';
                    data.forEach(function (estudiante) {
                        rows += '<tr>';
                        rows += '<td>' + estudiante.nombre + '</td>';
                        rows += '<td>' + estudiante.apellidos + '</td>';
                        rows += '<td>' + estudiante.dni_estudiante + '</td>';
                        rows += '<td>' + estudiante.n_celular + '</td>';
                        rows += '<td>' + estudiante.celular_apoderado + '</td>';
                        rows += '<td>';
                        rows += '<form action="/estudiante/' + estudiante.dni_estudiante + '" method="POST">';
                        rows += '<a href="/estudiante/' + estudiante.dni_estudiante + '" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-file-lines"></i></a>';
                        rows += '<button type="button" class="btn btn-sm btn-success btn-editar" data-bs-toggle="modal" data-bs-target="#editar" data-id="' + estudiante.id_estudiante + '" data-nombre="' + estudiante.nombre + '" data-apellido="' + estudiante.apellidos + '" data-dni_estudiante="' + estudiante.dni_estudiante + '" data-celular="' + estudiante.n_celular + '" data-direccion="' + estudiante.direccion + '" data-referencia="' + estudiante.referencia + '" data-colegio="' + estudiante.colegio + '" data-sede="' + estudiante.sede + '" data-celularApoderado="' + estudiante.celular_apoderado + '" data-estado="' + estudiante.estado_de_pago + '" data-pago="' + estudiante.pago + '" data-carrera="' + estudiante.carrera_id_carrera + '" data-especialidad="' + estudiante.especialidad + '" data-area="' + estudiante.area_academica_id_area + '" data-ciclo="' + estudiante.ciclo_id_ciclo + '" data-conducta="' + estudiante.conducta + '" data-observacion="' + estudiante.observacion + '" data-horario="' + estudiante.horario_id_horario + '" data-foto="' + estudiante.foto + '"><i class="fa fa-fw fa-edit"></i></button>';
                        rows += '<a href="/pdf/' + estudiante.dni_estudiante + '" class="btn btn-sm btn-body"><i class="fa-regular fa-file-pdf fa-lg"></i></a>';
                        rows += '<input type="hidden" name="_method" value="DELETE">';
                        rows += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                        rows += '</form>';
                        rows += '</td>';
                        rows += '</tr>';

                    });
                    $('#mytable2 tbody').html(rows);
                }
            })
        })
        $('#clear-button').on('click', function() {
            location.reload();
        });

    </script>


@endsection


