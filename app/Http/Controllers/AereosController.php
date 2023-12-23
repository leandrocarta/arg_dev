<?php

namespace App\Http\Controllers;

use App\Models\Aereo;
use Illuminate\Http\Request;

class AereosController extends Controller
{
    public function guardarDatos(Request $request)
    {
        $request->validate([
    'fecha_ida' => 'required|date',
    'fecha_regreso' => 'nullable|date', 
    'origen' => 'required|string',
    'destino' => 'required|string',
    'email' => 'required|email',
    'aclaracion' => 'string',
    'estado' => 'integer',
]);

$aereoData = [
    'fecha_ida' => $request->fecha_ida,
    'origen' => $request->origen,
    'destino' => $request->destino,
    'email' => $request->email,
    'aclaracion' => $request->aclaracion,
    'estado' => 1,
];

// Agregar la fecha de regreso solo si está presente
if ($request->has('fecha_regreso')) {
    $aereoData['fecha_regreso'] = $request->fecha_regreso;
}

Aereo::create($aereoData);

       // return redirect()->route('/home');
         return redirect('/')->with('success', 'Recibimos su consulta, en breve será respondida. Muchas Gracias');
    }
}
