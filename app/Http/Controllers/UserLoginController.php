<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.login_emprendedor_digital');
    }
    public function login(UserLoginRequest $request)
    {
        Auth::logout(); // Cerrar la sesión actual antes de iniciar sesión con otro usuario
        $credentials = $request->getCredentials();
        if (Auth::attempt($credentials)) {
            // Verificar si el usuario está verificado
            if (Auth::user()->email_verified_at === null) {
                Auth::logout();
                return back()->withErrors(['email' => 'Para iniciar sesión debe validar su cuenta siguiendo el link que le enviamos a su email.']);
                // return redirect('/login')->with('error', 'Debe verificar su correo electrónico ');
            }
            if ($request->hasCookie('reclutador_equipo_oficial')) { 
                if (Auth::user()->id_user_lider === null) {
                    $userId = $request->cookie('reclutador_equipo_oficial');
                    Auth::user()->id_user_lider = $userId;
                    Auth::user()->save();                
                }
            }
             
            // Usuario verificado, redirigir al panel
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Los datos ingresados no son validos']);
    }
    public function authenticated(Request $request, $user)
    {
        return redirect('/');
    }
}
