<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pais;
use App\Models\Rango;
use App\Models\Reunions;
use Illuminate\Support\Facades\Redirect;

class UserPresentationController extends Controller
{
    public function information(Request $request)
    {                
        $paises = Pais::all();
        $rangos = Rango::all(); 
         if ($request->hasCookie('reclutador_equipo_oficial')) { 
             $userId = $request->cookie('reclutador_equipo_oficial');
             $user = User::find($userId); 
             $elim_cookie = 'reclutador_equipo_oficial';
             setcookie($elim_cookie, '', time() - 3600, '/');
             return response()->view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos')); 
         } else {
           $userId = $request->query('reclutador_equipo_oficial');
           $user = User::find($userId);  
           if ($userId) {                                
                 if (!$user) {                    
                    $empresa = 1;
                    $userId = $empresa;           
                 } else {
                   $cookie = cookie('reclutador_equipo_oficial', $userId, 60 * 24 * 30 * 12); 
                   return response()->view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos'))->withCookie($cookie);
                 }
           } else {
            $empresa = 1;
            $userId = $empresa;
            $cookie = cookie('reclutador_equipo_oficial', $userId, 60 * 24 * 30 * 12); 
            return response()->view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos'))->withCookie($cookie);
           }
          }

        $userId = $request->query('reclutador_equipo_oficial'); 
       
        $paises = Pais::all();
        $rangos = Rango::all();
        if ($user) {
            return view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos'));
        } else {
            return view('user.oportunidad_trabajo_remoto_turismo', ['user' => $user ? $user : User::find(1), 'paises' => $paises, 'rangos' => $rangos]);
        }
    }
    public function registro(Request $request)
    {
        $liderEquipoOficial = $request->input('lider_equipo_oficial');
        if ($liderEquipoOficial) {
            $liderEquipoOficial = $request->input('lider_equipo_oficial');
        } else {
            $liderEquipoOficial = 1; // Valor predeterminado            
        }
        //  dd($request->all());

        $reunion = new Reunions();

        // Asignar los datos del formulario a los campos del modelo
        $reunion->name = $request->input('name');
        $reunion->email = $request->input('email');
        $reunion->pais = $request->input('pais');
        $reunion->id_user_lider = $liderEquipoOficial;
        $reunion->fecha_presentacion = $request->input('fecha_presentacion');

        $reunion->save();
        return Redirect::route('user.presentation', ['lider_equipo_oficial' => $request->input('lider_equipo_oficial')]);
    }
}
