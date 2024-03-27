@extends('layout.app')

@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Area /</span> Carrera</h4>

        <!-- Bootstrap 5 Accordion -->
        <div class="accordion" id="accordionExample">
            @foreach ($area_academicas as $key => $area_academica)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $key }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                            {{ $area_academica->nombre_area }}
                        </button>
                    </h2>
                    <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($area_academica->carrera as $carrera)
                                {{ $carrera->nombre_carrera }}<br/>
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
