<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViajeAMedida;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CotizacionAereosNotification;
use App\Notifications\CotizacionPaqueteNotification;

class ViajeAMedidaController extends Controller
{
     public function vista()
    {  
        return view('productos.mundo.a-medida');          
        }

    public function store(Request $request)
    {
        //dd($request->input());
        $request->validate([
            'nombre' => 'required|string', 
            'email' => 'required|email', 
            'fecha' => 'date', 
            'dias' => 'integer',  
            'destino' => 'string', 
            'habitaciones' => 'integer', 
            'servicio' => 'string',             
            
        ]);
        $paqueteData = [            
            'nombre' => $request->nombre,
            'email' => $request->email, 
            'fecha' => $request->fecha, 
            'dias' => $request->dias,  
            'destino' => $request->destino,
            'adultos' => $request->adultos,
            'menores' => $request->menores,
            'edad_menores' => $request->edad_menores, 
            'habitaciones' => $request->habitaciones,
            'servicio' => $request->servicio, 
            'info' => $request->info,
            'estado' => 0,
        ];

        ViajeAMedida::create($paqueteData);
        //ViajeAMedida::create($request->all());

        Notification::route('mail', 'leandrocarta@gmail.com')
        ->notify(new CotizacionPaqueteNotification($paqueteData));

        $url = url()->route('a-medida', ['id' => 'form']) . '#form';
        return redirect($url)->with('success', 'Sus datos se enviaron correctamente!!!');

        //return redirect('/a-medida')->with('success', '¡Formulario enviado con éxito!');
        //return redirect()->route('a-medida', ['id' => 'form'])->with('success', 'Sus datos se actualizaron correctamente!!!');
    }
}
