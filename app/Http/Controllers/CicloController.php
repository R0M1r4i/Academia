<?php

namespace App\Http\Controllers;

use App\Models\carrera;
use App\Models\ciclo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecicloRequest;
use App\Http\Requests\UpdatecicloRequest;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciclos = ciclo::all();
        return view('ciclo.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ciclo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecicloRequest $request)
    {
        $request->merge(['nombre_ciclo' => strtoupper($request->input('nombre'))]); //agrega nuevos elementos
        $request ->merge(['inico'=>$request ->input('inicio')]);
        $request ->merge(['fin'=>$request -> input('fin')]);

        $ciclo = ciclo::create($request->all());

        return redirect()->route('ciclo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ciclo $ciclo)
    {
        return view('ciclo.show', compact('ciclo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ciclo $ciclo)
    {
        return view('ciclo.edit', compact('ciclo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ciclo = ciclo::find($id);
        $ciclo->nombre_ciclo = strtoupper($request->input('nombre')); // Actualiza el nombre
        $ciclo->inicio = $request -> input( 'inicio');
        $ciclo->fin = $request -> input('fin');
        $ciclo->save();
        return redirect()->route('ciclo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ciclo $ciclo)
    {
        $ciclo->delete();
        return redirect()->route('ciclo.index');
    }
}

