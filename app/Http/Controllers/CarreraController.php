<?php

namespace App\Http\Controllers;

use App\Models\area_academica;
use App\Models\carrera;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecarreraRequest;
use App\Http\Requests\UpdatecarreraRequest;
use Illuminate\Http\Request;
class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_academicas = area_academica::all();
        $carreras = carrera::paginate(5);
        return view('carrera.index', compact('carreras','area_academicas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carrera.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecarreraRequest $request)
    {

        $request ->merge(['nombre_carrera'=>$request ->input('nombre')]);
        $request -> merge(['area_academica_id_area'=> $request ->input('area')]);

        $carrera = carrera::create($request->all());
        return redirect()-> route('carrera.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(carrera $carrera)
    {
        return view('carrera.show', compact('carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(carrera $carrera)
    {
        return view('carrera.edit', compact('carrera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $carrera = carrera::find($id);

        $carrera -> nombre_carrera = $request ->input('nombre');
        $carrera -> area_academica_id_area = $request ->input('area');

        $carrera -> save();
        return redirect()->route('carrera.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(carrera $carrera)
    {
        $carrera ->delete();
        return redirect() -> route('carrera.index');
    }

    public function area_academica()
    {
        return $this->belongsTo(area_academica::class, 'area_academica_id_area');
    }

    public function showDataTable_estudiante()
    {
        $carreras = carrera::with('estudiante')->get();
        return view('carrera.estudiante1-datatable', ['carreras' => $carreras]);

    }





}
