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
        if ($request->hasCookie('reclutador')) {        
            $userId = $request->cookie('reclutador');
           // dd('Existe la cookie o fue creada con el n:' . $userId);
           /* $elim_cookie = 'reclutador';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie n°: ', $userId); */
            $user = User::find($userId);
            if ($user) {
                return response()->view('user.lider_equipo', compact('user', 'paises', 'rangos'));
            } else {
                // Si el usuario no es válido, eliminamos la cookie y seguimos con el flujo
               $cookie = cookie('reclutador', '', -1); // Elimina la cookie
            }
        }
             // Si no existe la cookie o el usuario no es válido, se llega aquí
             // Verificamos si viene el parámetro reclutador en la URL
        if ($request->query('reclutador')) {
            $userId = $request->query('reclutador');
            //dd('Entre aca');
            // Si el parámetro 'reclutador' tiene valor (Opción 3)
            if (!empty($userId) && User::find($userId)) {
               // dd('Sigo aca para crear la cookie');
                // Asignamos el ID del reclutador de la URL si es válido
                $user = User::find($userId);
                // Crear la cookie para 'reclutador'
                $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);
                return response()->view('user.lider_equipo', compact('user', 'paises', 'rangos'))->withCookie($cookie);
            }else {
                $userId = User::inRandomOrder()->first()->id; // Asignar un ID aleatorio
                $user = User::find($userId);
                // Crear la cookie para 'reclutador' con el ID aleatorio
                $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);
                return response()->view('user.lider_equipo', compact('user', 'paises', 'rangos'))->withCookie($cookie);
            }
        }
        if (!isset($user)) {
            $userId = User::inRandomOrder()->first()->id; // Asignar un ID aleatorio
            $user = User::find($userId);
            // Crear la cookie para 'reclutador' con el ID aleatorio
            $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);
            return response()->view('user.lider_equipo', compact('user', 'paises', 'rangos'))->withCookie($cookie);
        }
        
    }
    public function registro(Request $request)
    {
        $paises = Pais::all();
        $rangos = Rango::all(); 
       if ($request->hasCookie('reclutador')) {        
            $userId = $request->cookie('reclutador');          
            $user = User::find($userId);
            if ($user) {
                
            } else {
                // Si el usuario no es válido, eliminamos la cookie y seguimos con el flujo
               $cookie = cookie('reclutador', '', -1); // Elimina la cookie
            }
        }
             // Si no existe la cookie o el usuario no es válido, se llega aquí
             // Verificamos si viene el parámetro reclutador en la URL
        if ($request->query('reclutador')) {
            $userId = $request->query('reclutador');            
            // Si el parámetro 'reclutador' tiene valor (Opción 3)
            if (!empty($userId) && User::find($userId)) {
               // dd('Sigo aca para crear la cookie');
                // Asignamos el ID del reclutador de la URL si es válido
                $user = User::find($userId);
                // Crear la cookie para 'reclutador'
                $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);                
            }else {
                $userId = User::inRandomOrder()->first()->id; // Asignar un ID aleatorio
                $user = User::find($userId);
                // Crear la cookie para 'reclutador' con el ID aleatorio
                $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);                
            }
        }
        if (!isset($user)) {
            $userId = User::inRandomOrder()->first()->id; // Asignar un ID aleatorio
            $user = User::find($userId);
            // Crear la cookie para 'reclutador' con el ID aleatorio
            $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);
        }

        $reunion = new Reunions();

        $reunion->name = $request->input('name');
        $reunion->email = $request->input('email');
        $reunion->pais = $request->input('pais');
        $reunion->id_user_lider = $userId;
        $reunion->fecha_presentacion = $request->input('fecha_presentacion');

        $reunion->save();
        $cookie = cookie('reclutador', $userId, 60 * 24 * 30 * 12);
        return redirect()->back()
         ->with('success', '¡Formulario enviado correctamente!')
         ->with('user', $user)
         ->with('paises', $paises)
         ->with('rangos', $rangos)
         ->withCookie($cookie);

       // return redirect()->back()->with('success', '¡Formulario enviado correctamente!');

       // return Redirect::route('user.presentation', ['reclutador_equipo_oficial' => $request->input('reclutador_equipo_oficial')]);
    }
}