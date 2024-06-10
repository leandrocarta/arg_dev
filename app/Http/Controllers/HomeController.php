<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Itinerario;
use App\Models\Destinos;
use App\Models\Client;
use App\Models\User;
use App\Models\Pais;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(Request $request)
    {                
       $productos = Producto::with(['hotel', 'service', 'itinerario', 'destinos', 'pais'])->get();
    
       // $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        $mostrarModal = false;
        if ($request->hasCookie('comercioAdherido')) {            
            $userId = $request->cookie('comercioAdherido'); 
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id  === null) {
                $cliente->fk_users_id  = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            if ($request->has('comercioAdherido')) {
            $mostrarModal = true;
            }
            $user = User::find($userId);
            if ($user) {    
            $nombreUsuario = $user->usuario;
            } else {    
             $nombreUsuario = 'Argtravels';
            }
          /*  $elim_cookie = 'comercioAdherido';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie n°: ', $userId); */
            return view('home', compact('productos', 'mostrarModal', 'nombreUsuario'));
        } else {            
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if ($user) {    
            $nombreUsuario = $user->usuario;
            } else {    
             $nombreUsuario = 'Argtravels';
            }
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id  === null) {
                $cliente->fk_users_id  = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            if ($request->has('comercioAdherido')) {               
            $mostrarModal = true;
            }
            return response()
                ->view('home', compact('productos', 'mostrarModal', 'nombreUsuario'))
                ->withCookie($cookie);
        }
        return view('home', compact('productos'));
    }
}
