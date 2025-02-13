<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Producto;
use App\Models\Service;
use App\Models\Itinerario;
use App\Models\Destino;
use App\Models\Aerolinea;
use App\Models\ItinerarioCupo;
use App\Models\Pais;
use App\Models\ProveedorMayorista;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
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
        $aerolineas = Aerolinea::all();
        return view('productos.crud.create_producto', compact('proveedores', 'paises', 'hoteles', 'destinos','aerolineas')); // Esto asume que tienes una vista llamada 'productos.create'
    }
    public function formUpdateProductos($id)
    {
        $proveedores = ProveedorMayorista::all();
        $destinos = Destino::all();
        $hoteles = Hotel::all();
        $paises = Pais::all();
        $producto = Producto::find($id);
        $aerolineas = Aerolinea::all();
        if (!$producto) {
            // Manejo del caso en que el producto no existe
        } else {
            return view('productos.crud.update_producto', compact('producto', 'paises', 'hoteles', 'destinos', 'proveedores', 'aerolineas'));
            
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
            if (!in_array($extension, ['jpeg', 'jpg', 'png','webp'])) {
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
            $producto->titulo = strtoupper($request->titulo);
            $producto->proveedor = $request->proveedor;
            $producto->fecha_salida = $request->fecha_salida;
            $producto->id_hotel = $request->id_hotel;
            $producto->id_destino = $request->id_destino;
            $producto->id_pais = $request->id_pais;
            $producto->id_aerolinea = $request->id_aerolinea;
            $producto->estadia = $request->estadia;
            $producto->habitacion = $request->habitacion;
            $producto->precio_total = $request->precio_total;
            $producto->descto = 0;
            $producto->moneda = $request->moneda;
            $producto->origen_salida = $request->origen_salida;
            $producto->tipo_producto = $request->tipo_producto;
            if($uploadedFile){
            $producto->imagen = $originalFileName;
            }  
            $producto->detalles = $request->detalles;
            $producto->comidas = $request->comidas; 
            $producto->ubicacion = $request->ubicacion;

            $producto->save();
        }
        return redirect('/read_producto')->with('success', 'EL PRODUCTO SE EDITO CORRECTAMENTE !!!');
    }

    public function createProd(Request $request)
    {
       //dd($request->all());
        $messages = [
            'codigo.unique' => 'EL CÓDIGO DEL PRODUCTO INGRESADO YA EXISTE.',
        ];
        $this->validate($request, [
            'titulo' => 'string',
            'proveedor' => 'string',
            'imagen' => 'image|mimes:jpeg,png,jpg,webp',
            'habitacion' => 'string',
            'tipo_producto' => 'string',
            'destinoGral' => 'string',
            'id_pais_destino' => 'integer',
            'id_aerolinea' => 'integer',
            'ciudad_destino' => 'integer',
            'origen_salida' => 'string',
            'precio_total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'descto' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'moneda' => 'string', 
            'hotel_principal' => 'string',
            'estadia_principal' => 'integer',
            'fecha_vencimiento' => 'date',
        ], $messages);
        $uploadedFile = $request->file('imagen');
        // dd($request->all());
        $timestamp = time();
        $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();

        $image = Image::make($uploadedFile);
        if ($image->width() > 1080) {
            $image->fit(1080, 720);
        } else {
            $image->fit(1080, 720);
        }    
        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        if (!in_array($extension, ['jpeg', 'jpg', 'png', 'webp'])) {
            Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
            return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
        } else {
            $image->save(public_path('assets/img_paquetes/' . $originalFileName));
            $producto = new Producto;
            $producto->titulo = strtoupper($request->titulo);
            $producto->proveedor = $request->proveedor;
            $producto->fecha_salida = $request->fecha_salida;
            $producto->id_hotel = $request->id_hotel;
            $producto->id_destino = $request->id_destino;
            $producto->id_pais = $request->id_pais;
            $producto->id_aerolinea = $request->id_aerolinea;
            $producto->estadia = $request->estadia;
            $producto->habitacion = $request->habitacion;
            $producto->precio_total = $request->precio_total;
            $producto->descto = 0;
            $producto->moneda = $request->moneda;
            $producto->origen_salida = $request->origen_salida;
            $producto->tipo_producto = $request->tipo_producto;                  
            $producto->detalles = $request->detalles;
            $producto->comidas = $request->comidas;
            $producto->ubicacion = $request->ubicacion;
            if($uploadedFile){
            $producto->imagen = $originalFileName;
            }     
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
    $productos = Producto::with([
        'hotel', 
        'service', 
        'destinos', 
        'aerolinea.itinerarios' 
    ])->find($id);

    if (!$productos) {
        return redirect()->route('productos.index')->withErrors('El producto no fue encontrado.');
    }

    return view('productos.detalles.detalles_productos', compact('productos'));
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
    
    
}