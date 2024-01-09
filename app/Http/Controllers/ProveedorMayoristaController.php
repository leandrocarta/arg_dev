<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProveedorMayorista;
use App\Models\Pais;

class ProveedorMayoristaController extends Controller
{
    public function crear(Request $request)
    {
        $request->validate([
            'nombre' => 'string',
            'direccion' => 'string',
            'telefono' => 'string',
            'email' => 'string',
            'ciudad' => 'string',
            'provincia' => 'string',            
            'pais' => 'string', 
        ]);

        $proveedor = ProveedorMayorista::create($request->all());

        return redirect('/mayorista_new');
    }

    public function listarMayoristas()
    {
        $mayoristas = ProveedorMayorista::all();
        
        return view('mayoristas.read_mayoristas', compact('mayoristas'));
    }
    public function mostrarFormulario()
    {
        $paises = Pais::all();
        return view('mayoristas.mayorista_new', compact('paises'));
    }
}
