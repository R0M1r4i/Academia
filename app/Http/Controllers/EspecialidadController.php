<?php

namespace App\Http\Controllers;

use App\Models\especialidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreespecialidadRequest;
use App\Http\Requests\UpdateespecialidadRequest;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidad = especialidad::all();
        return view('especialidad.index', ['especialidad' => $especialidad]);
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
    public function store(StoreespecialidadRequest $request)
    {
        $request -> merge(['nombre' => $request->input('nombre')]);

        $especiaidad = especialidad::create($request->all());

        return redirect()->route('especialidad.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(especialidad $especialidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $especialidad = especialidad::find($id);

        $especialidad -> nombre = $request ->input('nombre');

        $especialidad -> save();
        return redirect()->route('especialidad.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(especialidad $especialidad)
    {
        $especialidad ->delete();
        return redirect()->route('especialidad.index');
    }


}
