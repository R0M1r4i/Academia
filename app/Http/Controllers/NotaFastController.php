<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenotaFastRequest;
use App\Models\nota_fast;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storenota_fastRequest;
use App\Http\Requests\Updatenota_fastRequest;

use Illuminate\Http\Request;


class NotaFastController extends Controller
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
    public function store(StorenotaFastRequest $request)
    {
        $request ->merge(['nota'=>$request->input('nota')]);
        $request -> merge(['fecha'=> $request ->input('fecha')]);
        $request -> merge(['estudiante_dni_estudiante'=>$request ->input('dni_estudiante')]);

        $nota_fast = nota_fast::create($request->all());

        return redirect()->route('estudiante.show', $request->input('dni_estudiante'));
    }

    /**
     * Display the specified resource.
     */
    public function show(nota_fast $nota_fast)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(nota_fast $nota_fast)
    {
        return view( 'estudiante.show', compact('nota_fast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nota_fast = nota_fast::find($id);

        $nota_fast -> nota = $request ->input('nota');
        $nota_fast -> fecha= $request ->input( 'fecha');
        $nota_fast -> estudiante_id_estudiante = $request -> input('id_estudiante');

        $nota_fast -> save();
        return redirect()-> route('estudiante.show', $nota_fast -> estudiante_id_estudiante);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(nota_fast $nota_fast)
    {
        $estudiante_id = $nota_fast->estudiante_id_estudiante;
        $nota_fast->delete();
        return redirect()->route('estudiante.show', $estudiante_id);
    }



}
