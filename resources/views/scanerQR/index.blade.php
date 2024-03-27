@extends('layout.app')

@section('content')

    <!-- Content -->
    <!-- Scanner -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{asset('assets/plugins/qrCode.min.js')}}"></script>

    <div class="container-fluid flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Scaner /</span> Registro</h4>
                <div class="row mb-5">
                    <div class="col-md-6 col-lg-4">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="text-center">Escanear codigo QR</h5>

                                <div class="row text-center">
                                    <a id="btn-scan-qr" href="#">
                                        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center" width="175">
                                    </a>
                                    <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
                                </div>

                                <div class="row mx-5 my-3">
                                    <button class="btn rounded-pill btn-success mb-2" onclick="encenderCamara()">Encender</button>
                                    <button class="btn rounded-pill btn-danger" onclick="cerrarCamara()">Detener </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                    </div>
                </div>
            </div>
        </div>
        <!--/ Layout Demo -->
    </div>



    <!-- / Content -->
    <audio id="audioScaner" src="{{asset('assets/sonido.mp3')}}"></audio>

    <script src="{{asset('assets/js/index.js')}}"></script>



@endsection




