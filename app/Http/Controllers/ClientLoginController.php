<?php

namespace App\Http\Controllers;


use App\Http\Requests\ClientLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ClientLoginController extends Controller
{
    public function index()
    {
        return view('home.clientHome');
    }
    public function login(ClientLoginRequest $request)
    {
        // dd('Cliente autenticado con éxito');
        Auth::guard('client')->logout(); // Cerrar la sesión actual antes de iniciar sesión con otro cliente

        //$credentials = $request->getCredentials();
        $credentials = $request->getLoginCredentials();
        //dd($credentials);
        if (Auth::guard('client')->attempt($credentials)) {
            // dd($ver);
            if (Auth::guard('client')->user()->email_verified_at === null) {
                Auth::guard('client')->logout();
                return back()->withErrors(['email' => 'Para Iniciar Sesión debes validar tu cuenta siguiendo el Link que te enviamos al correo electrónico.']);
            }
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Los datos ingresados no son válidos']);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('/');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/clientHome');
        }
        return view('client.login_client');
    }
    public function recover()
    {
        return view('client.recover_password_client');
    }

    public function recoverPassword(Request $request)
    {
    }
}
