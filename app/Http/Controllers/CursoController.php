<?php

namespace App\Http\Controllers;

use App\Models\docente;
use App\Models\ciclo;
use App\Models\curso;
use App\Models\estudiante;
use App\Models\area_academica;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecursoRequest;
use App\Http\Requests\UpdatecursoRequest;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = curso::with('area_academica')->paginate(10);
        $docentes = docente::all();
        $ciclos = ciclo::all();
        $area_academicas =area_academica::all();

        return view('curso.index',compact('cursos','docentes','ciclos','area_academicas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecursoRequest $request)
    {
        // Obtén el último ID de la tabla curso
        $ultimoCurso = Curso::orderBy('id_curso', 'desc')->first();

        // Si la tabla está vacía, establece el ID inicial como 1, de lo contrario, suma 1 al último ID
        $nuevoId = $ultimoCurso ? $ultimoCurso->id_curso + 1 : 1;

        $request->merge(['id_curso' => $nuevoId]);
        $request->merge(['nombre_curso' => strtoupper($request->input('nombre'))]);
        $request->merge(['docente_dni_docente' => $request->input('docente')]);
        $request->merge(['ciclo_id_ciclo' => $request->input('ciclo')]);

        // Crea el curso y guárdalo en la base de datos

        $curso = Curso::create($request->all());

        // Ahora que el curso se ha guardado en la base de datos, puedes adjuntar las áreas académicas
        $areasSeleccionadas = $request->input('area_academica');

        // Verifica si se seleccionó alguna área académica antes de intentar adjuntarlas
        if ($areasSeleccionadas) {
            $curso->area_academica()->attach($areasSeleccionadas);
        }

        return redirect()->route('curso.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(curso $curso)
    {
        return view('curso.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(curso $curso)
    {
        return view('curso.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $curso = curso::find($id);

        $curso->nombre_curso =strtoupper($request-> input('nombre'));
        $curso -> docente_dni_docente = $request ->input('docente');
        $curso -> ciclo_id_ciclo = $request ->input('ciclo');

        $curso->save();

        // Luego, sincroniza las áreas académicas
        $areasSeleccionadas = $request->input('area_academica');
        if ($areasSeleccionadas) {
            $curso->area_academica()->sync($areasSeleccionadas);
        }

        return redirect() ->route('curso.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(curso $curso)
    {
        $curso ->  delete();
        return redirect() ->route('curso.index');
    }

    public function docente()
    {
        return $this->belongsTo(docente::class, 'docente_dni_docente');
    }

    public function ciclo()
    {
        return $this->belongsTo(ciclo::class, 'ciclo_id_ciclo');
    }

    public function area_academica()
    {
        return $this->belongsToMany(area_academica::class, 'area_academica_curso', 'curso_id', 'area_id');
    }

}

