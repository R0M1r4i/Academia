<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreareaAcademicaRequest;
use App\Models\area_academica;
use App\Models\carrera;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storearea_academicaRequest;
use App\Http\Requests\Updatearea_academicaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AreaAcademicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $area_academicas = area_academica::all();
        return view('area_academica.index', compact('area_academicas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('area_academica.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreareaAcademicaRequest $request)
    {
        $request->merge(['nombre_area' => $request->input('nombre')]); //agrega nuevos elementos

        $area_academica = area_academica::create($request->all());

        return redirect()->route('area_academica.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(area_academica $area_academica)
    {
        return view('area_academica.show', compact('area_academica'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(area_academica $area_academica)
    {
        return view('area_academica.edit', compact('area_academica'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $area_academica = area_academica::find($id);
        $area_academica->nombre_area = $request->input('nombre'); // Actualiza el nombre
        $area_academica->save();
        return redirect()->route('area_academica.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(area_academica $area_academica)
    {

        DB::transaction(function () use ($area_academica) {
            // Eliminar primero los registros dependientes
            area_academica::where('area_academica_id_area', $area_academica->id_area)->delete();

            // Luego eliminar el estudiante
            $area_academica->delete();
        });

        return redirect()->route('area_academica.index');
    }

    public function showDataTable()
    {
        $area_academicas = area_academica::with('carrera')->get();
        return view('area_academica.carrera-datatable', ['area_academicas' => $area_academicas]);

    }

    public function showDataTable_estudiante()
    {
        $area_academicas = area_academica::with('estudiante')->get();
        return view('area_academica.estudiante-datatable', ['area_academicas' => $area_academicas]);

    }

    public function curso()
    {
        return $this->belongsToMany(curso::class, 'area_academica_curso', 'area_id', 'curso_id');
    }

    public function getCarreras($id_area) {
        $carreras = carrera::where('area_academica_id_area', $id_area)->get();

        return response()->json($carreras);
    }


}
