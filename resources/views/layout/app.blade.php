<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />


    <title>Academia Municipal</title>

    <meta name="description" content="" />




    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo(2).png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />

    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    @stack('link')
    <!-- Page CSS -->

    <style>
        .form-control {
            text-transform: uppercase;
        }
    </style>





</head>


<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a  class="app-brand-link">
              <span class="app-brand-logo demo">
                   <img src="{{asset('img/logo(2).png')}}" alt="" style="width: 100%; height: 100%;" />
              </span>

                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="fa-solid fa-angles-left  ms-1 mt-1 bx-sm align-middle"></i>

                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item active">
                    <a  class="menu-link">
                        <i class="fa-solid fa-house me-3"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase"><span class="menu-header-text">Estudiante</span></li>

                <!-- Layouts -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-solid fa-graduation-cap me-3"></i>
                        <div data-i18n="Layouts">Estudiante</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('estudiante.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header small text-uppercase"><span class="menu-header-text">Docente</span></li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-solid fa-chalkboard-user me-3"></i>
                        <div data-i18n="Account Settings">Docente</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('docente.index') }}" class="menu-link">
                                <div data-i18n="Account">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-brands fa-elementor fa-lg me-3"></i>
                        <div data-i18n="Authentications">Curso</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('curso.index') }}" class="menu-link" >
                                <div data-i18n="Basic">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--Carera-->

                <li class="menu-header small text-uppercase"><span class="menu-header-text">Carrrera</span></li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-solid fa-layer-group me-3"></i>
                        <div data-i18n="Misc">Carrera</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('carrera.index') }}" class="menu-link">
                                <div data-i18n="Error">Registro</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/estudiante1-datatable') }}" class="menu-link">
                                <div data-i18n="Under Maintenance">Listar Estudiantes</div>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-solid fa-clone me-3"></i>
                        <div data-i18n="Form Elements">Area</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('area_academica.index') }}" class="menu-link">
                                <div data-i18n="Basic Inputs">Registro</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/estudiante-datatable') }}" class="menu-link">
                                <div data-i18n="Input groups">Listar Estudiante</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/carrera-datatable') }}" class="menu-link">
                                <div data-i18n="Input groups">Listar Carrera</div>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (Auth::user()->rol == 'superusuario')

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa-solid fa-stairs fa-lg me-2"></i>
                        <div data-i18n="Form Layouts">Ciclo</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('ciclo.index') }}" class="menu-link">
                                <div data-i18n="Vertical Form">Registro</div>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                <li class="menu-header small text-uppercase"><span class="menu-header-text">Asistencia</span></li>

                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="fa-solid fa-qrcode fa-lg me-3" ></i>
                        <div data-i18n="Extended UI">Scaner</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('scanerQR.index') }}" class="menu-link">
                                <div data-i18n="Perfect Scrollbar">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="fa-regular fa-calendar-days fa-lg  me-3"></i>
                        <div data-i18n="Extended UI">Horario</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('horario.index') }}" class="menu-link">
                                <div data-i18n="Perfect Scrollbar">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="fa-solid fa-sheet-plastic fa-lg me-3"></i>
                        <div data-i18n="Extended UI">Sabado</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('sabado.index') }}" class="menu-link">
                                <div data-i18n="Perfect Scrollbar">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>


                @if (Auth::user()->rol == 'superusuario')
                <!-- Usuario -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Usuario</span></li>

                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="fa-solid fa-user me-3"></i>
                        <div data-i18n="Extended UI">Usuario</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{  route('usuario.index') }}" class="menu-link">
                                <div data-i18n="Perfect Scrollbar">Registro</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="menu-item">
                    <a class="menu-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        <div data-i18n="Boxicons">Cerrar Sesion</div>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>




            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->


            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                    @yield('content')
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , hecho con ❤️ por
                            <a target="_blank" class="footer-link fw-bolder">Omar</a>
                        </div>
                        <div>
                            <a href="https://www.munichilca.gob.pe/site/" class="footer-link me-4" target="_blank">Municipalidad de Chilca</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/227112d106.js" crossorigin="anonymous"></script>

<!-- JS de Bootstrap (requiere jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Helpers -->
<script src="{{asset('assets/vendor/js/helpers.js')}}"></script>


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->


<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->


<!-- Chart Min -->
@stack('scripts')

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->

<!-- evitar  pegar -->

<script>
    window.onload = function() {
        var inputs = document.getElementsByClassName('form-control');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].onpaste = function(e) {
                e.preventDefault();
            }
        }
    }
</script>


<!--SweetAlert de Errores -->

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ $errors->first() }}',
        })
    </script>
@endif




</body>
</html>
