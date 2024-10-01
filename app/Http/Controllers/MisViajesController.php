<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Viaje;
use Illuminate\Support\Facades\Auth;

class MisViajesController extends Controller
{    
    public function index()
    {
        $productos = Producto::all();
        return view('client.mis_viajes', compact('productos'));
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {        
        //dd($request->all());
    $viaje = new Viaje();
    $viaje->id_cliente = $request->id_cliente;
    $viaje->id_producto = $request->id_producto;   
    $viaje->familias = $request->familias; 
    $viaje->adultos = $request->adultos;
    $viaje->menores = $request->menores;
    $viaje->edad_menores = $request->edad_menores;
    $viaje->habitaciones = $request->habitaciones;
    $viaje->comentario = $request->comentario;
    $viaje->save();

    // Redirigir o mostrar mensaje de éxito
    return redirect('/mis_viajes')->with('success', 'El viaje ha sido registrado con éxito.');
}

    

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy($id_producto)
{
    // Encuentra el registro en mis_viajes por id_producto y id_cliente
    $viaje = DB::table('mis_viajes')
                ->where('id_producto', $id_producto)
                ->where('id_cliente', Auth::guard('client')->user()->id)
                ->first();
    
    // Verifica si el viaje existe y pertenece al cliente autenticado
    if ($viaje) {
        DB::table('mis_viajes')
            ->where('id_producto', $id_producto)
            ->where('id_cliente', Auth::guard('client')->user()->id)
            ->delete();
        
        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }

    return redirect()->back()->with('error', 'No se pudo eliminar el producto.');
}


}
