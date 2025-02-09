<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Client;
use App\Models\MisViaje;

class PagoController extends Controller
{
     public function index()
{        
    // Obtener todos los pagos con la información del cliente y el viaje
    $pagos = Pago::with(['client', 'misViaje'])->get();

    // Obtener los clientes de los pagos sin duplicados
    $clientes = $pagos->pluck('client')->unique(); 

    return view('admin.pagos.index', compact('pagos', 'clientes'));
}
    public function create()
{
    $clientes = Client::all();
    $viajes = MisViaje::whereIn('client_id', $clientes->pluck('id'))->get(); // Filtra viajes por cliente
    return view('admin.pagos.create', compact('clientes', 'viajes'));
}

   public function store(Request $request)
{
    // Validación de los datos recibidos
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'mis_viajes_id' => 'required|exists:mis_viajes,id',
        'monto_pagado' => 'required|numeric|min:0',
        'tipo_pago' => 'required|in:reserva,cuota',
        'numero_cuota' => 'nullable|integer',
        'fecha_pago' => 'required|date',
        'metodo_pago' => 'required|string',
        'estado' => 'required|in:pendiente,confirmado,rechazado',
    ]);
    // Obtener el viaje asociado
    $viaje = MisViaje::findOrFail($request->mis_viajes_id);
    
    // Calcular el total de pagos previos con precisión
    $pagosPrevios = round(Pago::where('mis_viajes_id', $request->mis_viajes_id)->sum('monto_pagado'), 2);

    // Calcular el saldo pendiente asegurando precisión
    $saldoPendiente = round($viaje->valor_viaje - ($pagosPrevios + $request->monto_pagado), 2);

    // Crear el nuevo pago con valores redondeados
    $pago = Pago::create([
        'client_id' => $request->client_id,
        'mis_viajes_id' => $request->mis_viajes_id,
        'total_viaje' => round($viaje->valor_viaje, 2),  // Redondeamos el valor del viaje
        'monto_pagado' => round($request->monto_pagado, 2),
        'tipo_pago' => $request->tipo_pago,
        'numero_cuota' => $request->numero_cuota,
        'fecha_pago' => $request->fecha_pago,
        'metodo_pago' => $request->metodo_pago,
        'estado' => $request->estado,
        'saldo_pendiente' => $saldoPendiente, // Guardamos el saldo actualizado con precisión
    ]);

    return redirect()->route('admin.pagos')->with('success', 'Pago registrado correctamente.');
}
public function edit($id)
{
    // Buscar el pago por ID
    $pago = Pago::findOrFail($id);

    // Obtener la lista de clientes y viajes para el formulario de edición
    $clientes = Client::all();
    $viajes = MisViaje::all();

    // Retornar la vista de edición con los datos del pago
    return view('admin.pagos.edit', compact('pago', 'clientes', 'viajes'));
}
public function update(Request $request, $id)
{
    // Validación con solo los campos que el formulario envía
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'mis_viajes_id' => 'required|exists:mis_viajes,id',
        'monto_pagado' => 'required|numeric|min:0',
        'metodo_pago' => 'required|string',
        'estado' => 'required|in:pendiente,confirmado,rechazado',
    ]);

    // Buscar el pago a actualizar
    $pago = Pago::findOrFail($id);

    // Obtener el viaje asociado
    $viaje = MisViaje::findOrFail($request->mis_viajes_id);

    // Calcular el total de pagos previos excluyendo el pago actual
    $pagosPrevios = Pago::where('mis_viajes_id', $request->mis_viajes_id)
                        ->where('id', '!=', $id)
                        ->sum('monto_pagado');

    // Calcular saldo pendiente asegurando precisión
    $saldoPendiente = bcsub($viaje->valor_viaje, bcadd($pagosPrevios, $request->monto_pagado, 2), 2);

    // Actualizar los datos del pago
    $pago->update([
        'client_id' => $request->client_id,
        'mis_viajes_id' => $request->mis_viajes_id,
        'total_viaje' => $viaje->valor_viaje,
        'monto_pagado' => $request->monto_pagado,
        'metodo_pago' => $request->metodo_pago,
        'estado' => $request->estado,
        'saldo_pendiente' => $saldoPendiente,
    ]);

    return redirect()->route('admin.pagos')->with('success', 'Pago actualizado correctamente.');
}


public function destroy($id)
{
    // Buscar el pago por ID
    $pago = Pago::findOrFail($id);
    
    // Eliminar el pago
    $pago->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.pagos')->with('success', 'Pago eliminado correctamente.');
}
}