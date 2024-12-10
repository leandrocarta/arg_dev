<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FormDisney;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DisneyNotification;

class DisneyController extends Controller
{
   public function welcome(Request $request)
{
    if ($request->hasCookie('promotor_ventas')) {    
        $userId = $request->cookie('promotor_ventas');
       /* $elim_cookie = 'promotor_ventas';        
         setcookie($elim_cookie, '', time() - 3600, '/');
         dd('se elimino la cookie n°: ', $userId); */
        $user = User::find($userId);
        if ($user) {       
           return response()
                ->view('disney.disney');
        } else {
            $cookie = cookie('promotor_ventas', '', -1); // Elimina la cookie
            $userId = User::inRandomOrder()->first()->id; 
            $user = User::find($userId);
            $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 12);
            return response()
                ->view('disney.disney')
                ->withCookie($cookie);
        }
    }
    if ($request->query('promotor_ventas')) {   
        $userId = $request->query('promotor_ventas');        
        if (!empty($userId) && User::find($userId)) {                
                $user = User::find($userId);
                $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 12);
                return response()
                ->view('disney.disney')
                ->withCookie($cookie);
            }else {
                $userId = User::inRandomOrder()->first()->id; 
                $user = User::find($userId);
                $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 12);
                return response()
                ->view('disney.disney')
                ->withCookie($cookie);
            }       
    }  

    // Si no hay parámetro en la URL ni cookie, devuelve la vista con un user aleatorio.
    if (!isset($user)) {
            $userId = User::inRandomOrder()->first()->id; 
            $user = User::find($userId);
            $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 12);
            return response()
                ->view('disney.disney')
                ->withCookie($cookie);
        }   
}


    public function disneyUSA(Request $request)
{
    
        return response()
            ->view('disney.disney-usa');
    }


    public function eurodisney(Request $request)
    {
        if ($request->hasCookie('promotor_ventas')) {             
        $userId = $request->cookie('promotor_ventas');
        // dd('Entro en Reclutador N: ' . $userId);             
        $user = User::find($userId); 
        /* $elim_cookie = 'promotor_ventas';        
         setcookie($elim_cookie, '', time() - 3600, '/');
         dd('se elimino la cookie n°: ', $userId);*/
    } else {    
        // dd('En el Else');
        $userId = $request->query('promotor_ventas') ?? 1;  
        $user = User::find($userId); 
        if (!$user) {
            $userId = 1;
            $user = User::find(1);
        }
        // Creación de la cookie, adjuntada a la respuesta
        $cookie = cookie('promotor_ventas', $userId, 60 * 24 * 30 * 24);
        
        // Devolver la vista adjuntando la cookie a la respuesta
        return response()
            ->view('disney.eurodisney')
            ->cookie($cookie);
    }

    // Si la cookie ya existe, simplemente devuelves la vista sin necesidad de adjuntar la cookie de nuevo    
        return view('disney.eurodisney');
    }
    public function formDisneyUSA(Request $request)
    {                
         $request->validate([
        'promotor_ventas' => 'nullable|string',
        'email' => 'required|email',
        'name' => 'required|string',
        'disney' => 'required|string',
        'fecha' => 'required|string',
        'contacto' => 'required|string',
        'movil' => 'nullable|string',
    ]);

    // Obtener el valor de 'promotor_ventas' (en este caso, 'reclutador_equipo_oficial')
    $promotor_ventas = $request->input('promotor_ventas', 1); // Si no existe, asigna valor 1

    // Guardar los datos en la base de datos
    $paqueteData = [
        'promotor_ventas' => $promotor_ventas,
        'email' => $request->input('email'),
        'name' => $request->input('name'),
        'disney' => $request->input('disney'),
        'fecha' => $request->input('fecha'),
        'contacto' => $request->input('contacto'),
        'movil' => $request->input('movil'),
        'comentario' => $request->input('comentario'),
    ];
    FormDisney::create($paqueteData);

    Notification::route('mail', 'leandrocarta@gmail.com')
        ->notify(new DisneyNotification($paqueteData));

    return redirect()->back()->with('success', 'Ya recibimos tu consulta, en breve nos pondremos en contacto, muchas gracias.');
    }
    public function formEuroDisney(Request $request)
    {                
         $request->validate([
        'promotor_ventas' => 'nullable|string',
        'email' => 'required|email',
        'name' => 'required|string',
        'disney' => 'required|string',
        'fecha' => 'required|string',
        'contacto' => 'required|string',
        'movil' => 'nullable|string',
    ]);

    // Obtener el valor de 'promotor_ventas' (en este caso, 'promotor_ventas')
    $promotor_ventas = $request->input('promotor_ventas', 1); // Si no existe, asigna valor 1

    // Guardar los datos en la base de datos
    $paqueteData = [
        'promotor_ventas' => $promotor_ventas,
        'email' => $request->input('email'),
        'name' => $request->input('name'),
        'disney' => $request->input('disney'),
        'fecha' => $request->input('fecha'),
        'contacto' => $request->input('contacto'),
        'movil' => $request->input('movil'),
        'comentario' => $request->input('comentario'),
    ];
    FormDisney::create($paqueteData);

    Notification::route('mail', 'leandrocarta@gmail.com')
        ->notify(new DisneyNotification($paqueteData));

    return redirect()->back()->with('success', 'Ya recibimos tu consulta, en breve nos pondremos en contacto, muchas gracias.');
    }
}