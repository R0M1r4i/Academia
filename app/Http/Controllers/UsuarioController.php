<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreusuarioRequest;
use App\Http\Requests\UpdateusuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = usuario::all();

        return view('usuario.index', compact('usuario'));
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
    public function store(StoreusuarioRequest $request)
    {
        $usuario = new usuario;

        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->usuario = $request->input('usuario');
        $usuario->contraseña = Hash::make($request->input('contraseña')); // Hash de la contraseña con Bcrypt
        $usuario->rol = $request->input('rol');

        $usuario->save();

        return redirect()->route('usuario.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = usuario::find($id);

        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->usuario = $request->input('usuario');
        $usuario->contraseña = Hash::make($request->input('contraseña')); // Hash de la contraseña con Bcrypt
        $usuario->rol = $request->input('rol');

        $usuario->save();


        return redirect()->route('usuario.index');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuario.index');
    }

}

