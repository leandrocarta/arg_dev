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
    /*
    if ($request->hasCookie('promotor_ventas')) {
        // dd('Entre en hasCookie');
        $userId = $request->cookie('promotor_ventas');
        $elim_cookie = 'promotor_ventas';
        setcookie($elim_cookie, '', time() - 3600, '/');
        dd('se eliminoooo la cookie n°: ', $userId);
    }    */
    // Eliminar cookie solo si se solicita
    if ($request->query('clear_cookie') === 'true') {        
        $elim_cookie = 'promotor_ventas';
        setcookie($elim_cookie, '', time() - 3600, '/');

        // Obtener el ID actual o generar uno aleatorio para mostrarlo
        $userId = $request->cookie('promotor_ventas') ?? User::inRandomOrder()->first()->id;

        // Obtener productos relacionados para la vista
        $productos = Producto::with(['hotel', 'service', 'itinerario', 'destinos', 'pais'])->get();

        return response()->view('home', ['mensaje' => 'Cookie eliminada para pruebas. Último ID asignado: ' . $userId, 'productos' => $productos]);
    }

    // Obtención del userId de la cookie o generación aleatoria
    $userId = $request->cookie('promotor_ventas') ?? $request->query('promotor_ventas');
    if (empty($userId) || !User::find($userId)) {
        $userId = User::inRandomOrder()->first()->id ?? 1; // Usuario por defecto si no hay registros
    }

    // Crear o renovar la cookie con el ID del promotor
    $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 12); // Duración de 1 año

    // Si hay un cliente autenticado, vincularlo al promotor si aún no está asociado
    $cliente = auth()->guard('client')->user();
    if ($cliente && $cliente->fk_users_id === null) {
        $cliente->fk_users_id = $userId;
        try {
            $cliente->save();
        } catch (\Exception $e) {
            return response()->view('error', ['message' => $e->getMessage()]);
        }
    }

    // Obtener información del promotor para mostrar en la vista
    $user = User::find($userId);
    $nombreUsuario = $user ? $user->usuario : 'Argtravels';

    // Obtener productos relacionados
    $productos = Producto::with(['hotel', 'service', 'itinerario', 'destinos', 'pais'])->get();

    // Determinar si mostrar el modal (puedes ajustar la lógica según necesidad)
    $mostrarModal = $request->has('promotor_ventas');

    // Retornar la vista con la cookie adjunta
    return response()
        ->view('home', compact('productos', 'mostrarModal', 'nombreUsuario'))
        ->withCookie($cookie);
}

    public function index2(Request $request)
    {                
        dd('entro normal sin promotor de ventas');
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