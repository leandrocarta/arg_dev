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
            // $elim_cookie = 'reclutador_equipo_oficial';
            // setcookie($elim_cookie, '', time() - 3600, '/');
            // dd('Cookie de usuario eliminada: ' . $userId);
             return response()->view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos')); 
         } else {    
           $userId = $request->query('reclutador_equipo_oficial', 1);  
           $user = User::find($userId); 
           if (!$user) {
           $userId = 1;
           $user = User::find(1);
           }            
           $cookie = cookie('reclutador_equipo_oficial', $userId, 60 * 24 * 30 * 12); 
           return response()->view('user.oportunidad_trabajo_remoto_turismo', compact('user', 'paises', 'rangos'))->withCookie($cookie);  
          }     
    }
    public function registro(Request $request)
    {
        $reclutadorEquipoOficial = $request->input('reclutador_equipo_oficial');
        if ($reclutadorEquipoOficial) {
            $reclutadorEquipoOficial = $request->input('reclutador_equipo_oficial');
        } else {
            $reclutadorEquipoOficial = 1; // Valor predeterminado            
        }
        //  dd($request->all());

        $reunion = new Reunions();

        // Asignar los datos del formulario a los campos del modelo
        $reunion->name = $request->input('name');
        $reunion->email = $request->input('email');
        $reunion->pais = $request->input('pais');
        $reunion->id_user_lider = $reclutadorEquipoOficial;
        $reunion->fecha_presentacion = $request->input('fecha_presentacion');

        $reunion->save();
        return Redirect::route('user.presentation', ['reclutador_equipo_oficial' => $request->input('reclutador_equipo_oficial')]);
    }
}
