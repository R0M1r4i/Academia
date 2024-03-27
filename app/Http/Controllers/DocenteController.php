<?php

namespace App\Http\Controllers;

use App\Models\docente;
use App\Models\estudiante;
use App\Models\asistencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredocenteRequest;
use App\Http\Requests\UpdatedocenteRequest;
use Illuminate\Http\Request;


class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function generarHash($dni_docente) {
        return encrypt($dni_docente);
    }

    public function obtenerId($hash) {
        return decrypt($hash);
    }

    public function index()
    {
        $docentes = docente::paginate(10);
        return view('docente.index',compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredocenteRequest $request)
    {
        $request->merge(['dni_docente'=>$request->input('dni_docente')]);

        $request->merge(['nombre_docente' => strtoupper($request->input('nombre'))]);
        $request->merge(['apellido_docente'=> strtoupper($request->input('apellido'))]);
        $request->merge(['celular' => strtoupper($request->input('celular'))]);
        $request->merge(['horario_inicio'=> strtoupper($request->input('horario_inicio'))]);
        $request->merge(['horario_final' => strtoupper($request->input('horario_final'))]);

        $docente = docente::create($request->all());

        return redirect()->route('docente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($dni_docente)
    {
        /**
         * $puntaje = $docente->puntaje()->('puntaje');
         *
         */

        $docente = docente::find($dni_docente);
        $asistencia = $docente->asistencia()->paginate(10);

        $asistencias_count = asistencia::where('docente_dni', $docente->dni_docente)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = asistencia::where('docente_dni', $docente->dni_docente)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = asistencia::where('docente_dni', $docente->dni_docente)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('docente.show', compact('docente','asistencia','asistencias_count', 'tardanzas_count', 'inasistencias_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(docente $docente)
    {
        return view('docente.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dni_docente)
    {
        $docente = docente::find($dni_docente);

        $docente -> nombre_docente = strtoupper($request->input('nombre'));
        $docente -> apellido_docente = strtoupper($request ->input('apellido'));
        $docente -> dni_docente = strtoupper($request -> input('dni_docente'));
        $docente -> celular = strtoupper($request -> input('celular'));
        $docente -> rendimiento = strtoupper($request -> input('rendimiento'));
        $docente -> horario_inicio = strtoupper($request -> input('horario_inicio'));
        $docente -> horario_final = strtoupper($request -> input('horario_final'));

        $docente -> save();
        return redirect()->route('docente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(docente $docente)
    {
        $docente  ->delete();
        return redirect()->route('docente.index');
    }

    public function showDataTable_estudiante2()
    {
        $docentes = docente::with('estudiante')->get();
        $estudiantes = estudiante::all();
        return view('docente.estudiante2-datatable', ['docentes' => $docentes, 'estudiantes'=>$estudiantes]);
    }

    public function informacion($hash)
    {
        $dni_docente = $this->obtenerId($hash);

        $docente = docente::find($dni_docente);
        $asistencia = $docente->asistencia()->paginate(3);

        $asistencias_count = Asistencia::where('docente_dni', $dni_docente)
            ->where('valor_asistencia', 'asistencia')
            ->count();
        $tardanzas_count = Asistencia::where('docente_dni', $dni_docente)
            ->where('valor_asistencia', 'tardanza')
            ->count();
        $inasistencias_count = Asistencia::where('docente_dni', $dni_docente)
            ->where('valor_asistencia', 'inasistencia')
            ->count();

        return view('docente.informacion', compact('docente', 'asistencia', 'asistencias_count', 'tardanzas_count', 'inasistencias_count'));
    }




}
