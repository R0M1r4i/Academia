<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use App\Models\carrera;
use App\Models\area_academica;
use App\Models\docente;

use App\Models\estudiante;
use App\Models\ciclo;
use App\Models\especialidad;
use App\Models\curso;
use App\Models\nota_fast;
use App\Models\nota_eta;
use App\Models\horario;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreestudianteRequest;
use App\Http\Requests\UpdateestudianteRequest;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function generarHash($dni_estudiante) {
        return encrypt($dni_estudiante);
    }

    public function obtenerId($hash) {
        return decrypt($hash);
    }

    public function index()
    {
        $horarios = horario::all();
        $area_academicas = area_academica::all();
        $carreras = Carrera::all();
        $ciclos = Ciclo::all();
        $estudiantes = Estudiante::paginate(10);

        return view('estudiante.index', compact('estudiantes','area_academicas', 'carreras', 'ciclos', 'horarios'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreestudianteRequest $request)
    {
        $file = $request->file('foto');
        $filename = 'estudiante_' . $request->input('dni_estudiante') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('foto'), $filename);

        // Crear el estudiante
        $estudiante = new estudiante;
        $estudiante->dni_estudiante = strtoupper($request->input('dni_estudiante'));
        $estudiante->nombre = strtoupper($request->input('nombre'));
        $estudiante->apellidos = strtoupper($request->input('apellido'));
        $estudiante->n_celular = strtoupper($request->input('celular'));
        $estudiante->direccion = strtoupper($request->input('direccion'));
        $estudiante->colegio = strtoupper($request->input('colegio'));
        $estudiante->sede = $request->input('sede');
        $estudiante->celular_apoderado = strtoupper($request->input('celularApoderado'));
        $estudiante->estado_de_pago = strtoupper($request->input('estado'));
        $estudiante->pago = $request->input('pago');
        $estudiante->carrera_id_carrera = strtoupper($request->input('carrera'));
        $estudiante->especialidad = strtoupper($request->input('especialidad'));
        $estudiante->area_academica_id_area = strtoupper($request->input('area'));
        $estudiante->ciclo_id_ciclo = strtoupper($request->input('ciclo'));
        $estudiante->referencia = strtoupper($request->input('referencia'));
        $estudiante->conducta = strtoupper('excelente');
        $estudiante->observacion = strtoupper($request->input('observacion'));
        $estudiante->horario_id_horario = strtoupper($request->input('horario'));
        $estudiante->foto = $filename;

        // Guardar el estudiante
        $estudiante->save();

        return redirect()->route('estudiante.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(estudiante $estudiante)
    {
        $horarios = horario::all();
        $area_academicas = area_academica::all();
        $carreras = Carrera::all();
        $ciclos = Ciclo::all();
        $estudiantes = Estudiante::paginate(10);

        $nota_fast = DB::table('notafasttest')
            ->where('estudiante_dni_estudiante', $estudiante->dni_estudiante)
            ->paginate(3);

        $nota_eta = nota_eta::where('estudiante_dni_estudiante', $estudiante->dni_estudiante)->first();

        $promedio = $estudiante->nota_eta()->avg('nota');

        $asistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('estudiante.show', compact('estudiante', 'nota_fast', 'nota_eta', 'promedio', 'asistencias_count', 'tardanzas_count', 'inasistencias_count','estudiantes','area_academicas', 'carreras', 'ciclos', 'horarios'));
    }


    public function informacion( $hash)
    {
        $id = $this->obtenerId($hash);

        // Carga el estudiante y su área académica
        $estudiante = estudiante::with('area_academica')->find($id);

        $nota_fast = DB::table('notafasttest')
            ->where('estudiante_dni_estudiante', $estudiante->dni_estudiante)
            ->paginate(3);
        $nota_eta = nota_eta::where('estudiante_dni_estudiante', $estudiante->dni_estudiante)->first();

        $promedio = $estudiante->nota_eta()->avg('nota');

        $asistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('estudiante.informacion', compact('estudiante', 'nota_fast', 'nota_eta', 'promedio', 'asistencias_count', 'tardanzas_count', 'inasistencias_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estudiante $estudiante)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudiante = estudiante::find($id);

        if ($request->hasFile('foto')) {
            // Elimina la foto antigua si existe
            if ($estudiante->foto) {
                Storage::delete($estudiante->foto);
            }

            // Almacena la nueva foto y obtén la ruta
            $file = $request->file('foto');
            $filename = 'estudiante_' . $request->input('dni_estudiante') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $filename);

            // Asigna la nueva ruta de la foto al estudiante
            $estudiante->foto = $filename;
        }

        $estudiante->nombre = strtoupper($request->input('nombre'));
        $estudiante->apellidos = strtoupper($request->input('apellido'));
        $estudiante->n_celular = strtoupper($request->input('celular'));
        $estudiante->direccion = strtoupper($request->input('direccion'));
        $estudiante->colegio = strtoupper($request->input('colegio'));
        $estudiante->sede = $request->input('sede');
        $estudiante->celular_apoderado = strtoupper($request->input('celularApoderado'));
        $estudiante->estado_de_pago = $request->input('estado');
        $estudiante->pago = strtoupper($request->input('pago'));
        $estudiante->carrera_id_carrera = strtoupper($request->input('carrera'));
        $estudiante->especialidad = strtoupper($request->input('especialidad'));
        $estudiante->area_academica_id_area = strtoupper($request->input('area'));
        $estudiante->ciclo_id_ciclo = strtoupper($request->input('ciclo'));
        $estudiante->referencia = strtoupper($request->input('referencia'));
        $estudiante->conducta = strtoupper('excelente');
        $estudiante->observacion = strtoupper($request->input('observacion'));
        $estudiante->horario_id_horario = strtoupper($request->input('horario'));

        $estudiante->save();

        return redirect()->route('estudiante.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estudiante $estudiante)
    {
        DB::transaction(function () use ($estudiante) {
            // Eliminar primero los registros dependientes
            asistencia::where('estudiante_dni_estudiante', $estudiante->dni_estudiante)->delete();

            // Luego eliminar el estudiante
            $estudiante->delete();
        });

        return redirect()->route('estudiante.index');
    }



    public function carrera()
    {
        return $this->belongsTo(carrera::class, 'carrera_id_carrera');
    }



    public function asistencia($dni_estudiante)
    {
        $estudiante = estudiante::find($dni_estudiante);
        $asistencia = $estudiante->asistencia()->paginate(8);


        $asistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('estudiante.asistencia', compact('estudiante', 'asistencia', 'asistencias_count', 'tardanzas_count', 'inasistencias_count'));
    }


    public function asistencia2($hash)
    {
        $dni_estudiante = $this->obtenerId($hash);
        $estudiante = estudiante::find($dni_estudiante);
        $asistencia = $estudiante->asistencia()->paginate(6);

        $asistencias_count = Asistencia::where('estudiante_dni', $dni_estudiante)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = Asistencia::where('estudiante_dni', $dni_estudiante)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = Asistencia::where('estudiante_dni', $dni_estudiante)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('estudiante.asis_info', compact('estudiante', 'asistencia', 'asistencias_count', 'tardanzas_count', 'inasistencias_count'));
    }

    public function informativo(estudiante $estudiante)
    {

        return view('login.informativo', compact('estudiante'));
    }

    public function intro()
    {

        return view('estudiante.intro');
    }


    public function registroAsistencia(Request $request)
    {
        // El DNI del estudiante o docente se obtiene del código QR
        $qr_code = $request->input('qr_code');

        // Buscar al estudiante o docente en la base de datos
        $estudiante = estudiante::where('dni_estudiante', $qr_code)->first();

        // Establecer la zona horaria a 'America/Lima'
        date_default_timezone_set('America/Lima');

        // Obtener la hora y fecha actual
        $hora_actual = date('H:i:s');
        $fecha_actual = date('Y-m-d');

        if ($estudiante) {
            // Verificar si ya existe un registro de asistencia para el estudiante en el día actual
            $asistenciaExistente = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
                ->where('fecha', $fecha_actual)
                ->first();
            if ($asistenciaExistente) {
                // Si ya existe un registro, redirigir a la página de asistencia del estudiante
                return redirect()->route('estudiante.asistencia', $estudiante->dni);
            }

            // Obtener el horario del estudiante
            $horario = horario::find($estudiante->horario_id_horario);

            // Comparar la hora actual con el horario del estudiante
            if ($hora_actual > $horario->h_final) {
                $valor_asistencia = 'inasistencia';
            } else if ($hora_actual > $horario->h_inicio) {
                $valor_asistencia = 'tardanza';
            } else {
                $valor_asistencia = 'asistencia';
            }

            // Crear el registro de asistencia
            $asistencia = asistencia::create([
                'valor_asistencia' => $valor_asistencia,
                'estudiante_dni' => $estudiante->dni_estudiante,
                'hora' => $hora_actual,
                'fecha' => $fecha_actual,
            ]);
            // Redirigir a la página de asistencia del estudiante
            return redirect()->route('estudiante.asistencia', $estudiante->dni);
        }
        else {
            // Redirigir a la página de error si el DNI no se encuentra en la base de datos
            return view('error');
        }
    }

//BUSCAR ESTUDIANTES
    public function search(Request $request)
    {
        $query = strtolower($request->get('query'));
        $estudiantes = DB::table('estudiante')
            ->whereRaw('LOWER(nombre) LIKE ?', "%{$query}%")
            ->orWhereRaw('LOWER(apellidos) LIKE ?', "%{$query}%")
            ->orWhereRaw('LOWER(dni_estudiante) LIKE ?', "%{$query}%")
            ->get();

        return response()->json($estudiantes);
    }


    public function countEstudiantes() {
        $count = Estudiante::count();
        return response()->json($count);
    }

}

