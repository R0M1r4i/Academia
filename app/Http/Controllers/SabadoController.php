<?php

namespace App\Http\Controllers;

use App\Models\sabado;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoresabadoRequest;
use App\Http\Requests\UpdatesabadoRequest;
use Illuminate\Http\Request;

class SabadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sabados = sabado::all();

        return view('sabado.index', compact('sabados'));
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
    // En tu controlador
    public function store(StoresabadoRequest $request)
    {
        if(sabado::count() >= 6) {
            return redirect()->route('sabado.index')->with('count', sabado::count());
        }

        $request -> merge(['fecha'=> $request ->input('fecha')]);

        $sabado = sabado::create($request->all());

        return redirect()->route('sabado.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(sabado $sabado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sabado $sabado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sabado = sabado::find($id);

        $sabado -> fecha = $request->input('fecha');

        $sabado -> save();

        return redirect()->route('sabado.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sabado $sabado)
    {
        //
    }
}
