<?php

namespace App\Http\Controllers;


use App\Http\Requests\ClientLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientLoginController extends Controller
{
    public function index()
    {
        return view('home.clientHome');
    }
    public function login(ClientLoginRequest $request)
    {
        Auth::guard('client')->logout(); 
        $credentials = $request->getLoginCredentials();
        if (Auth::guard('client')->attempt($credentials)) {
            // dd($ver);
            if (Auth::guard('client')->user()->email_verified_at === null) {
                Auth::guard('client')->logout();
                return back()->withErrors(['email' => 'Para Iniciar Sesión debes validar tu cuenta siguiendo el Link que te enviamos al correo electrónico.']);
            }
            if ($request->hasCookie('promotorOficialVerificado')) { 
                if (Auth::guard('client')->user()->fk_users_id  === null) {
                    $userId = $request->cookie('promotorOficialVerificado');
                   $user = Auth::guard('client')->user();
                   if ($user) {
                       $user->fk_users_id  = $userId;
                       $user->save();
                   }               
                }
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
       $client = Client::where('email', $request->input('usuario'))->first();
       
    if ($client) {
        $temporaryPassword = Str::random(8);
        $client->updatePassword($temporaryPassword); // Utiliza el método en la instancia del modelo
        $client->save();
        dd($temporaryPassword);
        return redirect()->back()->with('success', 'Hemos enviado instrucciones para recuperar tu contraseña a tu correo electrónico.');
    } else {
        dd('Entre');
        return redirect()->back()->withErrors(['error' => 'El correo electrónico ya existe'])->withInput();
    }
    }
}
