<?php

namespace App\Http\Controllers;

use App\Models\horario;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorehorarioRequest;
use App\Http\Requests\UpdatehorarioRequest;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = horario::all();

        return view('horario.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorehorarioRequest $request)
    {
        $request->merge(['h_inicio'=>$request->input('inicio')]);
        $request->merge(['h_final'=>$request->input('final')]);
        $request->merge(['nombre' =>$request ->input('nombre')]);

        $horario = horario::create($request->all());
        return redirect()->route('horario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $horario = horario::find($id);

        $horario -> nombre = $request -> input('nombre');
        $horario -> h_inicio = $request->input('inicio');
        $horario -> h_final = $request ->input('final');

        $horario -> save();

        return redirect()->route('horario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(horario $horario)
    {

    }
}
