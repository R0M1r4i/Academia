<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenotaEtaRequest;
use App\Models\nota_eta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storenota_etaRequest;
use App\Http\Requests\Updatenota_etaRequest;
use Illuminate\Http\Request;

class NotaEtaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiante.show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenotaEtaRequest $request)
    {
        $request-> merge(['nota'=>$request->input('nota')]);
        $request-> merge(['fecha'=>$request->input('fecha')]);
        $request-> merge(['estudiante_dni_estudiante'=>$request->input('dni_estudiante')]);

        $nota_eta = nota_eta::create($request->all());

        return redirect()->route('estudiante.show', $request->input('dni_estudiante'));

    }

    /**
     * Display the specified resource.
     */
    public function show(nota_eta $nota_eta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(nota_eta $nota_eta)
    {
        return view('estudiante.show',compact('nota_eta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nota_eta = nota_eta::find($id);

        $nota_eta -> nota = $request -> input('nota');
        $nota_eta -> fecha = $request -> input('fecha');
        $nota_eta -> estudiante_dni_estudiante = $request -> input('dni_estudiante');

        $nota_eta -> save();

        return redirect()-> route('estudiante.show', $nota_eta -> estudiante_dni_estudiante);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(nota_eta $nota_eta)
    {
        $estudiante_id = $nota_eta->estudiante_id_estudiante;
        $nota_eta->delete();
        return redirect()->route('estudiante.show', $estudiante_id);
    }
}

