<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItinerarioCupo;
use App\Models\Aerolinea;

class ItinerarioCupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itinerarios = ItinerarioCupo::all();
        return view('productos.aerolineasItinerarios.itinerario-cupos', compact('itinerarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aerolineas = Aerolinea::all();
         return view('productos.aerolineasItinerarios.itinerario-cupos-news', compact('aerolineas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'aerolinea_id' => 'required|exists:aerolinea,id',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date',
            'hora_salida' => 'required|date_format:H:i',
            'fecha_llegada' => 'required|date',
            'hora_llegada' => 'required|date_format:H:i',
        ]);
        ItinerarioCupo::create($request->all());
         return redirect('/itinerario-cupos')->with('success', 'Aerolínea creada correctamente.');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $itinerario = ItinerarioCupo::findOrFail($id); // Encuentra el itinerario por su ID
         $aerolineas = Aerolinea::all(); // Obtiene todas las aerolíneas
         return view('productos.aerolineasItinerarios.edit', compact('itinerario', 'aerolineas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Normalizar las horas para asegurarse de que estén en formato H:i
    $request->merge([
        'hora_salida' => substr($request->hora_salida, 0, 5), // Extrae HH:mm si incluye segundos
        'hora_llegada' => substr($request->hora_llegada, 0, 5),
    ]);

    try {
        $request->validate([
            'aerolinea_id' => 'required|exists:aerolinea,id',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'hora_salida' => 'required|date_format:H:i',
            'hora_llegada' => 'required|date_format:H:i',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
        ]);
    } catch (ValidationException $e) {
        return redirect()
            ->back()
            ->withErrors($e->errors())
            ->withInput(); // Devuelve los valores enviados
    }

    // Encuentra el registro y actualiza los datos
    $itinerario = ItinerarioCupo::findOrFail($id);
    $itinerario->num_vuelo = $request->num_vuelo;
    $itinerario->aerolinea_id = $request->aerolinea_id;
    $itinerario->origen = $request->origen;
    $itinerario->destino = $request->destino;
    $itinerario->hora_salida = $request->hora_salida;
    $itinerario->hora_llegada = $request->hora_llegada;
    $itinerario->fecha_salida = $request->fecha_salida;
    $itinerario->fecha_llegada = $request->fecha_llegada;

    // Guarda los cambios
    $itinerario->save();

    // Redirige con un mensaje de éxito
    return redirect()->route('itinerario_cupos.index')->with('success', 'Itinerario actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itinerario = ItinerarioCupo::findOrFail($id); // Busca el itinerario por su ID
    $itinerario->delete(); // Elimina el itinerario

    return redirect()->route('itinerario_cupos.index')->with('success', 'Itinerario eliminado correctamente.');
    }
}