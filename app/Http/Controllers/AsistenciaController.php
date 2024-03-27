<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use App\Models\estudiante;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreasistenciaRequest;
use App\Http\Requests\UpdateasistenciaRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use function Laravel\Prompts\alert;
use function Webmozart\Assert\Tests\StaticAnalysis\allUnicodeLetters;
use Illuminate\Database\QueryException;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencia = asistencia::all();
        return view('asistencia.index', compact('asistencia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asistencia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreasistenciaRequest $request)
    {
        $request -> merge(['valor_asistencia'=> $request -> input('valor')]);
        $request -> merge(['estudiante_dni'=> $request ->input('dni_estudiante')]);
        $request -> merge(['docente_dni' => $request ->input('dni_docente')]);
        $request -> merge(['hora'=>$request->input('hora')]);
        $request -> merge(['fecha'=>$request -> input('fecha')]);

        $asistencia = asistencia::create($request->all());

        if ($request->input('dni_docente')) {
            return redirect()->route('docente.show', $request->input('dni_docente'));
        } else if ($request->input('dni_estudiante')) {
            return redirect()->route('estudiante.asistencia', $request->input('dni_estudiante'));
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(asistencia $asistencia)
    {
        return view('asistencia.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asistencia $asistencia)
    {
        return view('asistencia.edit', compact('asistencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id_asistencia)
    {
        $asistencia = asistencia::find($id_asistencia);

        if ($asistencia) {
            $asistencia -> valor_asistencia = $request ->input('valor');
            $asistencia -> estudiante_dni = $request -> input('dni_estudiante');
            $asistencia -> docente_dni = $request -> input('dni_docente');
            $asistencia -> hora = $request ->input('hora');
            $asistencia -> fecha = $request ->input('fecha');

            $asistencia -> save();
        }

        if ($request->input('dni_docente')) {
            return redirect()->route('docente.show', $request->input('dni_docente'));
        } else if ($request->input('dni_estudiante')) {
            return redirect()->route('estudiante.asistencia', $request->input('dni_estudiante'));
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($dni_estudiante)
    {
        $asistencia = asistencia::find($dni_estudiante);

        if ($asistencia) {
            $estudiante_dni = $asistencia->estudiante_dni_estudiante;
            $asistencia->delete();
            return redirect()->route('estudiante.asistencia', ['dni_estudiante' => $estudiante_dni]);
        } else {
            // Manejar el caso en el que no se encuentre ninguna asistencia
            return redirect()->back()->with('error', 'No se encontró ninguna asistencia con esa ID');
        }
    }



}

