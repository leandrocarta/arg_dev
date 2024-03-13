<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Producto;
use App\Models\Service;
use App\Models\Itinerario;
use App\Models\Destino;
use App\Models\Pais;
use App\Models\ProveedorMayorista;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    // Paquetes turisticos
    public function mostrarProductos()
    {       
        $productos = Producto::all();
        $paises = Pais::all();
        $destinos = Destino::all();
        return view('productos.crud.read_producto', compact('productos', 'paises', 'destinos'));
    }
    public function paquetes()
    {       
        $productos = Producto::with(['hotel', 'service','destinos'])->get();
        return view('productos.paquetes.paquetes', compact('productos'));
    }
    public function grupales()
    {       
        $productos = Producto::with(['hotel', 'service','destinos'])->get();
        return view('productos.grupales.grupales', compact('productos'));
    }
    public function showFormProd()
    {
        $proveedores = ProveedorMayorista::all();
        $hoteles = Hotel::all();
        $paises = Pais::all();
        $destinos = Destino::all();
        return view('productos.crud.create_producto', compact('proveedores', 'paises', 'hoteles', 'destinos')); // Esto asume que tienes una vista llamada 'productos.create'
    }
    public function formUpdateProductos($id)
    {
        $destinos = Destino::all();
        $hoteles = Hotel::all();
        $paises = Pais::all();
        $producto = Producto::find($id);
        if (!$producto) {
            // Manejo del caso en que el producto no existe
        } else {
            return view('productos.crud.update_producto', compact('producto', 'paises', 'hoteles', 'destinos'));
            
        }
    }
    public function editarProducto(Request $request, $id)
    {
        $producto = Producto::find($id);
        $oldImageName = $producto->imagen;
        $uploadedFile = $request->file('imagen');
        if ($uploadedFile) {
            $oldImageName = $producto->imagen;
        if ($oldImageName) {
            $oldImagePath = public_path('assets/img_paquetes/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        } 
            $extension = strtolower($uploadedFile->getClientOriginalExtension());
            if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {
                Session::flash('error_message', 'Ooops!!! Hubo un error, revisa el formulario.');
                return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
            } else {
                if ($oldImageName) {
                    $oldImagePath = public_path('assets/img_paquetes/' . $oldImageName);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $timestamp = time();
                $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();
                $image = Image::make($uploadedFile);
                $image->save(public_path('assets/img_paquetes/' . $originalFileName), 99);
                $producto->imagen = $originalFileName;
            }
        }
        if ($producto) {
            $producto->nombre = strtoupper($request->nombre);
            $producto->proveedor = $request->proveedor;
            $producto->habitacion = $request->habitacion;
            $producto->tipo_producto = $request->tipo_producto;
            $producto->id_pais_destino = $request->pais_destino;
            $producto->id_destino = $request->ciudad_destino;
            $producto->origen_salida = $request->origen_salida;
            $producto->precio_total = $request->precio_total;
            $producto->moneda = $request->moneda;
            $producto->detalles = $request->detalles;
            $producto->id_hotel = $request->hotel_principal;
            $producto->estadia = $request->estadia_principal;

            $producto->save();
        }
        return redirect('/read_producto')->with('success', 'EL PRODUCTO SE EDITO CORRECTAMENTE !!!');
    }

    public function createProd(Request $request)
    {
        $messages = [
            'codigo.unique' => 'EL CÓDIGO DEL PRODUCTO INGRESADO YA EXISTE.',
        ];
        $this->validate($request, [
            'nombre' => 'string',
            'proveedor' => 'string',
            'imagen' => 'image|mimes:jpeg,png,jpg',
            'habitacion' => 'string',
            'tipo_producto' => 'string',
            'destinoGral' => 'string',
            'id_pais_destino' => 'integer',
            'ciudad_destino' => 'integer',
            'origen_salida' => 'string',
            'precio_total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'descto' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'moneda' => 'string', 
            'detalles' => 'string',
            'hotel_principal' => 'string',
            'estadia_principal' => 'integer',
            'fecha_vencimiento' => 'date',
        ], $messages);
        $uploadedFile = $request->file('imagen');

        $timestamp = time();
        $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();

        $image = Image::make($uploadedFile);
        if ($image->width() > 1080) {
            $image->fit(1080, 720);
        } else {
            $image->fit(1080, 720);
        }    
        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {
            Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
            return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
        } else {
            $image->save(public_path('assets/img_paquetes/' . $originalFileName));
            $producto = new Producto;
            $producto->nombre = strtoupper($request->nombre);
            $producto->proveedor = $request->proveedor;
            $producto->imagen = $originalFileName;
            $producto->habitacion = $request->habitacion;
            $producto->tipo_producto = $request->tipo_producto;
            $producto->destino_gral = $request->destinoGral;
            $producto->id_pais_destino = $request->pais_destino;
            $producto->id_destino = $request->ciudad_destino;
            $producto->origen_salida = $request->origen_salida;
            $producto->precio_total = $request->precio_total;
            $producto->descto = $request->descto;
            $producto->moneda = $request->moneda;
            $producto->detalles = $request->detalles;
            $producto->id_hotel = $request->hotel_principal;
            $producto->estadia = $request->estadia_principal;
            $producto->fecha_vencimiento = $request->fecha_vencimiento;

            //$producto->solo_adultos = $request->has('solo_adultos') ? true : false;
            $producto->save();
        }

        $itinerario = new Itinerario;
        $itinerario->dia1 = $request->input('dia1');
        $itinerario->dia2 = $request->input('dia2');
        $itinerario->dia3 = $request->input('dia3');
        $itinerario->dia4 = $request->input('dia4');
        $itinerario->dia5 = $request->input('dia5');
        $itinerario->dia6 = $request->input('dia6');
        $itinerario->dia7 = $request->input('dia7');
        $itinerario->dia8 = $request->input('dia8');
        $itinerario->dia9 = $request->input('dia9');
        $itinerario->dia10 = $request->input('dia10');
        $itinerario->dia11 = $request->input('dia11');
        $itinerario->dia12 = $request->input('dia12');
        $itinerario->dia13 = $request->input('dia13');
        $itinerario->dia14 = $request->input('dia14');
        $itinerario->dia15 = $request->input('dia15');
        if ($itinerario->dia1) {
        $itinerario->id_prod = $producto->id;
        $itinerario->save();
        }
        $service = new Service;
        $service->transporte_int = $request->input('transporte_int');
        $service->traslados_orig = $request->input('traslados_orig');
        $service->traslados_dest = $request->input('traslados_dest');
        $service->estadía = $request->input('estadía');
        $service->comidas = $request->input('comidas');
        $service->seguro = $request->input('seguro');
        $service->id_prod = $producto->id;
        $service->save();

        return redirect('/read_producto')->with('success', 'EL PRODUCTO SE CREÓ CORRECTAMENTE');
    }
    public function detalle_producto($id)
{
    $productos = Producto::with(['hotel', 'service', 'destinos'])->find($id);

    if (!$productos) {

    } else {     

        return view('productos.detalles.detalles_productos', compact('productos'));
    }
    
}

    public function deleteProductos($id)
    {
        $producto = Producto::find($id);
        $oldImageName = $producto->imagen;
        if (!$producto) {
            return redirect('/read_producto')->with('success', 'EL PRODUCTO NO EXISTE!!!');
        }
        // Elimina la imagen asociada al producto
        if ($oldImageName) {
            $oldImagePath = public_path('assets/img_paquetes/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Elimina el producto de la base de datos
        $producto->delete();

        return redirect('/read_producto')->with('success', 'PRODUCTO ELIMINADO CON EXITO!!!');
    }
    // Seccion productos Vuelos
    
    
}
