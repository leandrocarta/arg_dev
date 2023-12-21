<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;

class ViajeController extends Controller
{
    public function guardarDatos(Request $request)
    {
        //dd($request->input('id'));
        $request->validate([
            'id' => 'required|integer',
            'adultos' => 'integer',
            'menores' => 'integer',
            'nombre' => 'required|string',
            'email' => 'required|email',
            'consulta' => 'string|nullable',
        ]);

        Viaje::create([
            'id_producto' => $request->id,
            'adultos' => $request->adultos,
            'menores' => $request->menores,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'consulta' => $request->consulta,
            'estado' => 1,
        ]);

        return redirect('/detalles_productos/'. $request->input('id'))->with('success', 'Recibimos su consulta sobre este maravilloso destino. A la brevedad nos pondremos en contacto. Muchas Gracias');
    }
}
