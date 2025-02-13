<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MisViaje;
use App\Models\Client;
use App\Models\Destino;
use App\Models\Hotel;
use App\Models\Pago;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class MisViajeController extends Controller
{
    public function adminIndex()
    {
        $viajes = MisViaje::with(['client', 'producto', 'hotel', 'pagos'])->get();        
        
        $clientes = $viajes->pluck('client')->unique();

        return view('client_admin.admin_mis_viajes', compact('viajes', 'clientes'));
    }

    // Mostrar todos los viajes a los clientes
    public function index()
    {
        $viajes = MisViaje::with(['client', 'destino', 'hotel'])->get();
        return view('client.mis_viajes', compact('viajes'));
    }

    public function misViajesCliente()
    {
        if (!Auth::guard('client')->check()) {
        return redirect()->route('client.login')->with('error', 'Debes iniciar sesión para acceder.');
    }

    $viajes = MisViaje::where('client_id', Auth::guard('client')->id())->with(['producto', 'hotel'])->get();
    return view('client.mis_viajes', compact('viajes'));
    }

    // Mostrar formulario para crear un nuevo viaje
    public function create()
    {
        $clientes = Client::all();
        $productos = Producto::all();
        
        return view('client_admin.admin_mis_viajes_create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'id_producto' => 'required|exists:productos,id',
            'hotel_id' => 'required|exists:hotels,id',
            'valor_viaje' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string',
            'notas' => 'nullable|string',
        ]);
        
        MisViaje::create($validated);

        return redirect()->route('admin.misViajes')->with('success', 'Viaje creado con éxito.');
    }

    public function edit($id)
    {
        $viaje = MisViaje::findOrFail($id); // Buscar el viaje por ID
        $clients = Client::all(); // Obtener todos los clientes
        $productos = Producto::all(); // Obtener todos los destinos
        $hotels = Hotel::all(); // Obtener todos los hoteles

        return view('client_admin.admin_mis_viajes_edit', compact('viaje', 'clients', 'productos', 'hotels'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'id_producto' => 'required|exists:productos,id',
            'hotel_id' => 'required|exists:hotels,id',
            'valor_viaje' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string',
            'notas' => 'nullable|string',
        ]);

        // Encontrar el viaje y actualizar los datos
        $viaje = MisViaje::findOrFail($id);
        $viaje->update($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.misViajes')->with('success', 'Viaje actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Buscar el viaje por ID y eliminarlo
        $viaje = MisViaje::findOrFail($id);
        $viaje->delete();

        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('admin.misViajes')->with('success', 'Viaje eliminado con éxito.');
    }
}