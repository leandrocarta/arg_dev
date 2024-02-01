<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\PasswordRecoveryNotificationUser;


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
        Auth::logout(); 
        $credentials = $request->getCredentials();
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at === null) {
                Auth::logout();
                return back()->withErrors(['email' => 'Para iniciar sesión debe validar su cuenta siguiendo el link que le enviamos a su email.']);                
            }
            if ($request->hasCookie('reclutador_equipo_oficial')) { 
                if (Auth::user()->id_user_lider === null) {
                    $userId = $request->cookie('reclutador_equipo_oficial');
                    Auth::user()->id_user_lider = $userId;
                    Auth::user()->save();                
                }
            }
             
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Los datos ingresados no son validos']);
    }
    public function authenticated(Request $request, $user)
    {
        return redirect('/');
    }
    public function recover()
    {
        return view('user.recover_password_emprendedor');
    }
     public function recoverPassword(Request $request)
    {
       $user = User::where('email', $request->input('usuario'))->first();
      // dd($user);
    if ($user) {
        $temporaryPassword = Str::random(8);
        $user->updatePassword($temporaryPassword); 
        $user->save();

        $user->notify(new PasswordRecoveryNotificationUser($temporaryPassword));
      //  dd($temporaryPassword);
      //  return redirect()->back()->with('success', 'Te enviamos por email una nueva contraseña, puedes utilizar la misma o cambiarla desde tu administrador.');
       return redirect()->back()->with('success', 'Te enviamos por email una nueva contraseña, puedes utilizar la misma o cambiarla desde tu administrador.');
    //  return view('user.login_emprendedor_digital')->with('success', 'Te enviamos por email una nueva contraseña, puedes utilizar la misma o cambiarla desde tu administrador.');
    } else {
        return back()->withErrors(['email' => 'Los datos ingresados no son válidos']);
    }
    }
}
