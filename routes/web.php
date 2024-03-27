<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





    Route::get('/', function () {
        return view('login.index');
    });


    Route::middleware(['auth:sanctum','verified'])->group(function () {




        Route::resource('area_academica', \App\Http\Controllers\AreaAcademicaController::class);

        Route::resource('asistencia', \App\Http\Controllers\AsistenciaController::class);
        Route::resource('carrera', \App\Http\Controllers\CarreraController::class);
        Route::resource('ciclo', \App\Http\Controllers\CicloController::class);
        Route::resource('curso', \App\Http\Controllers\CursoController::class);
        Route::resource('docente', \App\Http\Controllers\DocenteController::class);


        Route::resource('usuario', \App\Http\Controllers\UsuarioController::class);
        Route::resource('especialidad', \App\Http\Controllers\EspecialidadController::class);
        Route::resource('scanerQR', \App\Http\Controllers\ScanerQRController::class);
        Route::resource('horario', \App\Http\Controllers\HorarioController::class);
        Route::resource('sabado',\App\Http\Controllers\SabadoController::class);

        Route::put('especialidad/{especialidad}',[\App\Http\Controllers\EspecialidadController::class,'update']);
        Route::put('/estudiante/{estudiante}', [\App\Http\Controllers\EstudianteController::class, 'update']);

        //FILTROS

        Route::get('/carrera-datatable', [\App\Http\Controllers\AreaAcademicaController::class, 'showDataTable']);

        Route::get('/estudiante-datatable', [\App\Http\Controllers\AreaAcademicaController::class, 'showDataTable_estudiante']);

        Route::get('/estudiante1-datatable', [\App\Http\Controllers\CarreraController::class, 'showDataTable_estudiante']);

        Route::get('/estudiante2-datatable', [\App\Http\Controllers\DocenteController::class, 'showDataTable_estudiante2']);

        Route::get('/estudiante2-datatable', [\App\Http\Controllers\DocenteController::class, 'showDataTable_estudiante2']);


        //FAST TEST

        Route::delete('/nota_fast/{nota_fast}', [\App\Http\Controllers\NotaFastController::class, 'destroy'])->name('nota_fast.destroy');

        Route::post('/nota_fast', [\App\Http\Controllers\NotaFastController::class, 'store'])->name('nota_fast.store');

        Route::put('/nota_fast/{id}', [\App\Http\Controllers\NotaFastController::class, 'update'])->name('nota_fast.update');

        // ETA

        Route::post('/nota_eta', [\App\Http\Controllers\NotaEtaController::class, 'store'])->name('nota_eta.store');

        Route::put('/nota_eta/{dni_estudiante}', [\App\Http\Controllers\NotaEtaController::class, 'update'])->name('nota_eta.update');

        Route::delete('/nota_eta/{nota_eta}', [\App\Http\Controllers\NotaEtaController::class, 'destroy'])->name('nota_eta.destroy');

        // ASISTENCIA

        Route::post('/asistencia', [\App\Http\Controllers\AsistenciaController::class, 'store'])->name('asistencia.store');

        Route::put('/asistencia/{dni_estudiante}', [\App\Http\Controllers\AsistenciaController::class, 'update'])->name('asistencia.update');


        Route::delete('/asistencia/{asistencia}', [\App\Http\Controllers\AsistenciaController::class, 'destroy'])->name('asistencia.destroy');

        Route::get('/estudiante/asistencia', [\App\Http\Controllers\EstudianteController::class, 'asistecia']);

        //CONTADOR DE DIAS
        Route::get('estudiante/{dni_estudiante}/asistencia', '\App\Http\Controllers\EstudianteController@asistencia')->name('estudiante.asistencia');

        Route::get('docente/{dni_docente}/show', '\App\Http\Controllers\DocenteController@show')->name('docente.show');

        //WHATSAPP

        Route::get('/envia', [\App\Http\Controllers\WaController::class, 'envia']);

        //PDF
        Route::get('/pdf/{dni_estudiante}', '\App\Http\Controllers\PDFController@generatePDF');

        Route::get('/pdf2/{dni_docente}', '\App\Http\Controllers\PDF2Controller@generatePDF');

        //SCANER

        Route::post('/upload', 'ScanerQRController@upload');


        Route::post('/registro-asistencia', '\App\Http\Controllers\EstudianteController@registroAsistencia')->name('estudiante.registroAsistencia');

        //validacion

        Route::get('/validar-asistencias', '\App\Http\Controllers\EstudianteController@validarAsistencias')->name('estudiante.validarAsistencias');

        //Carrera por Area

        Route::get('/carreras/{id_area}', '\App\Http\Controllers\AreaAcademicaController@getCarreras')->name('area_academica.getCarreras');



        Route::resource('estudiante', \App\Http\Controllers\EstudianteController::class);
            Route::get('/estudiantes/count', '\App\Http\Controllers\EstudianteController@countEstudiantes') -> name('estudiante.countEstudiantes');
            Route::get('/search', '\App\Http\Controllers\EstudianteController@search')->name('estudiante.search');

    });


    //publica



    //LOGIN PARA PADRES

    Route::get('/login/loginPadres', '\App\Http\Controllers\LoginController@showLoginForm')->name('login.form');

    Route::post('/login/loginPadres', [\App\Http\Controllers\LoginController::class, 'loginPadres'])->name('login.loginPadres');

    Route::get('/estudiante/informativo/{estudiante}', [App\Http\Controllers\EstudianteController::class, 'informativo'])->name('estudiante.informativo');


    //

    Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::resource('login', \App\Http\Controllers\LoginController::class);

    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login.login');

    Route::get('/admin', [\App\Http\Controllers\UsuarioController::class, 'admin']);


    Route::get('/estudiante/informacion/{hash}', [\App\Http\Controllers\EstudianteController::class, 'informacion'])->name('estudiante.informacion');
    Route::get('/estudiante/{hash}/asis_info', [\App\Http\Controllers\EstudianteController::class, 'asistencia2'])->name('estudiante.asis_info');

    Route::get('/docente/informacion/{hash}', [\App\Http\Controllers\DocenteController::class, 'informacion'])->name('docente.informacion');



    Route::get('/error', function () {

        return view('error');
    })->name('error.page');







