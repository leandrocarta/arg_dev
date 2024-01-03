<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViajeAMedida;
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
            'adultos' => 'integer',
            'menores' => 'integer',
            'presupuesto' => 'string',
            'hotel' => 'string',
            'actividades' => 'string',
            'salud' => 'string',
            'itinerario' => 'string',
            'expectativas' => 'string',
            'otro' => 'string',
        ]);

        ViajeAMedida::create($request->all());

        return redirect('/a-medida')->with('success', '¡Formulario enviado con éxito!');
    }
}
