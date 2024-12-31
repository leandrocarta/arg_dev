<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aerolinea;


class AerolineaController extends Controller
{
    // Mostrar todas las aerolíneas
    public function index()
    {
        $aerolineas = Aerolinea::all();
        return view('productos.aerolineas.aerolinea', compact('aerolineas'));
    }

    // Mostrar el formulario para crear una nueva aerolínea
    public function create()
    {         
        $aerolineas = Aerolinea::all();
        return view('productos.aerolineas.aerolinea_news', compact('aerolineas'));
    }

    // Guardar una nueva aerolínea en la base de datos
    public function store(Request $request)
    {       
        Aerolinea::create($request->all());
        return redirect('/aerolineas')->with('success', 'Aerolínea creada correctamente.');
    }

    // Mostrar el formulario para editar una aerolínea existente
    public function edit($id)
    {
        $aerolinea = Aerolinea::findOrFail($id);
        return view('productos.aerolineas.edit', compact('aerolinea'));
    }

    // Actualizar una aerolínea existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'compania' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:1500',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        $aerolinea = Aerolinea::find($id);
        if (!$aerolinea) {
        return redirect('/aerolineas')->with('error', 'Aerolínea no encontrada.');
        }

        // Actualizar los datos manualmente para mayor claridad
        $aerolinea->penalidad = $request->input('penalidad');
        $aerolinea->compania = $request->input('compania');
        $aerolinea->descripcion = $request->input('descripcion');
        $aerolinea->fecha_inicio = $request->input('fecha_inicio');
        $aerolinea->fecha_fin = $request->input('fecha_fin');
        $aerolinea->save();
         return redirect('/aerolineas')->with('success', 'Aerolínea creada correctamente.');
        //return redirect()->route('aerolineas.index')->with('success', 'Aerolínea actualizada correctamente.');
    }

    // Eliminar una aerolínea
    public function destroy($id)
    {
        $aerolinea = Aerolinea::find($id);
        $aerolinea->delete();
        return redirect('/aerolineas')->with('success', 'Aerolínea creada correctamente.');
    }
}