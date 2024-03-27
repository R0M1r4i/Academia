<?php

namespace App\Http\Controllers;

use App\Models\estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use App\Models\usuario;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginController extends Controller
{
    public function index()
    {
        // Aquí puedes definir la lógica para mostrar una vista de inicio o redirigir a otra ruta
        return view('login.index');
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $user = usuario::where('usuario', $credentials['usuario'])->first();

        if ($user && Hash::check($credentials['contraseña'], $user->contraseña)) {
            Auth::login($user);
            return redirect()->intended(route('estudiante.index'));
        } else {
            // manejar el caso cuando las credenciales son incorrectas
            return back()->withErrors([
                'usuario' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ])->with('error', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
        }
    }









    public function logout()
    {

        Auth::logout();

        // Redirige a donde quieras después del cierre de sesión
        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('login.loginPadres');
    }


    public function loginPadres(Request $request)
    {
        $dni = $request->input('dni_estudiante');

        $estudiante = Estudiante::where('dni_estudiante', $dni)->first();

        if ($estudiante) {
            Auth::login($estudiante);
            return redirect()->action(
                [EstudianteController::class, 'informativo'], ['estudiante' => $estudiante]
            );
        } else {
            return back()->withErrors([
                'dni_estudiante' => 'El DNI ingresado no corresponde a ningún estudiante.',
            ]);
        }
    }




}
