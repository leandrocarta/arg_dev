<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoCrucero;
class ProductoCruceroController extends Controller
{
     public function mostrarProductos()
    {       
        $productos = ProductoCrucero::all();       
        return view('productos.cruceros.read_crucero', compact('productos'));
    }
    public function showFormCru()
    {
        return view('productos.cruceros.create_crucero');
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
