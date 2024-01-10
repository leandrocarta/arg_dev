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
            'empresa' => 'string',
            'contacto' => 'string',
            'direccion' => 'string',
            'telefono' => 'string',
            'email' => 'string',
            'ciudad' => 'string',
            'provincia' => 'string',            
            'pais' => 'string', 
        ]);

        $proveedor = ProveedorMayorista::create($request->all());

        return redirect('/read_mayoristas')->with('success', 'EL MAYORISTA SE CREO CORRECTAMENTE!!!');
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
    public function formUpdateMayorista($id)
    {        
        $mayorista = ProveedorMayorista::find($id);
        if (!$mayorista) {
            // Manejo del caso en que el producto no existe
        } else {
            return view('mayoristas.update_mayorista', compact('mayorista'));
        }
    }
     public function editarMayorista(Request $request, $id)
    {
       $mayorista = ProveedorMayorista::find($id);     

        if ($mayorista) {
            $mayorista->empresa = $request->empresa;
            $mayorista->contacto = $request->contacto;
            $mayorista->direccion = $request->direccion;
            $mayorista->telefono = $request->telefono;
            $mayorista->email = $request->email;
            $mayorista->localidad = $request->localidad;
            $mayorista->provincia = $request->provincia;
            $mayorista->pais = $request->pais;

            $mayorista->save();
        }
        return redirect('/read_mayoristas')->with('success', 'EL PRODUCTO SE EDITO CORRECTAMENTE !!!');
    }
    public function deleteMayorista($id)
    {
        $mayorista = ProveedorMayorista::find($id);
        if (!$mayorista) {
            return redirect('/read_mayoristas')->with('success', 'EL PRODUCTO NO EXISTE!!!');
        }      

        $mayorista->delete();

        return redirect('/read_mayoristas')->with('success', 'Se ha eliminado al Mayorista!!!');
    }
}
