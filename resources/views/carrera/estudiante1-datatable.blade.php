@extends('layout.app')

@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Carrera /</span> Estudiante</h4>

        <!-- Content -->
            <!-- Bootstrap 5 Accordion -->
            <div class="accordion" id="accordionExample">
                @foreach ($carreras as $key => $carrera)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"  data-bs-collapse="true" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                {{ $carrera->nombre_carrera }}
                            </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($carrera->estudiante as $estudiante)
                                    {{ $estudiante->nombre }}
                                    {{ $estudiante->apellidos }} DNI:
                                    {{ $estudiante->dni_estudiante }}<br/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--/ Bootstrap 5 Accordion -->
        </div>
        <!-- Content -->

@endsection
