@extends('layout.app2')

@section('content')


    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bienvenido(a) /</span> {{ $estudiante->nombre }} {{ $estudiante->apellidos }}</h4>

                <!-- Text alignment -->

                <div class="row mb-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Encuesta del Docente</h5>
                                <p class="card-text">Encuesta elaborada para el estudiante para conocer el rendimiento de nuestros docentes</p>
                                <a href="javascript:void(0)" onclick="mostrarSweetAlert()" class="btn btn-primary">Ingresar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Informacion del estudiante</h5>
                                <p class="card-text">Cosulte Informacion como: asistencias, notas, conducta, entre otros.</p>
                                <a href="{{ route('estudiante.informacion', app()->make('App\Http\Controllers\EstudianteController')->generarHash($estudiante->dni_estudiante)) }}" class="btn btn-primary">Ingresar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Comunicate con Nosotros</h5>
                                <p class="card-text">Comunicate con nostros para solicitar informacion, quejas y sugerencias: +51 904 971 286 </p>

                                <a href="https://api.whatsapp.com/send?phone=51904971286&text=%C2%A1Quiero%20m%C3%A1s%20informaci%C3%B3n%20acerca%20de%20la%20Academia%20Municipal%20de%20Chilca!%F0%9F%91%A8%E2%80%8D%F0%9F%8E%93" class="btn btn-primary">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Text alignment -->


                <!-- Striped Rows Asistencia -->

                <!--/ Striped Rows Asistencia -->

            </div>
        </div>
        <!--/ Layout Demo -->
    </div>
    <!-- / Content -->


    <!-- Scripts -->

    <script>
        function mostrarSweetAlert() {
            let timerInterval;
            Swal.fire({
                title: "Pronto se habilitaran las Encuestas",
                html: "El mensaje se cerrará en <b></b> milisegundos.",
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        }

    </script>




    <!-- / Scripts -->


@endsection

