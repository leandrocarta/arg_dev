<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReciboPago;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReciboPagosNotification;

class ReciboPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.reciboPagos.recibo_pagos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email = $request->email;
       
        $reciboPagos = [            
            'nombre' => $request->nombre,
            'apellido' => $request->apellido, 
            'dni' => $request->dni, 
            'email' => $request->email,  
            'concepto' => $request->concepto,
            'moneda' => $request->moneda,
            'importe' => $request->importe,
            'fecha' => $request->fecha, 
        ];
        ReciboPago::create($reciboPagos);

        Notification::route('mail', $email)
        ->notify(new ReciboPagosNotification($reciboPagos));

        $url = url()->route('recibo_pagos', ['id' => 'form']) . '#form';
        return redirect($url)->with('success', 'Sus datos se enviaron correctamente!!!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
