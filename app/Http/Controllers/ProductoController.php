<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Producto;
use App\Models\Pais;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function showFormHotel() {
    return view('productos.hotel.hotel_news');
}

    public function createHotel(Request $request)
{
    // Valida los datos ingresados por el usuario
    $this->validate($request, [
        'nombre' => 'required|string',
        'categoria' => 'required|integer',
    ]);

    // Crea un nuevo hotel en la base de datos
    $hotel = new Hotel;
    $hotel->nombre = $request->nombre;
    $hotel->categoria = $request->categoria;
    $hotel->save();

    
    return redirect('/hotel_news')->with('success', 'Hotel creado exitosamente');
}
public function mostrarProductos() {
    $productos = Producto::all();
    return view('productos.crud.read_producto', compact('productos'));
    
}
public function showFormProd()
{
    $hoteles = Hotel::all();
    $paises = Pais::all();
    return view('productos.crud.create_producto', compact('paises', 'hoteles')); // Esto asume que tienes una vista llamada 'productos.create'
}
public function formUpdateProductos($id)
{
    $hoteles = Hotel::all();
    $paises = Pais::all();
    $producto = Producto::find($id);
    if (!$producto) {
        // Manejo del caso en que el producto no existe
    }else {
    return view('productos.crud.update_producto', compact('producto', 'paises', 'hoteles'));
    //return view('productos.crud.update_producto');
    }

}
public function editarProducto(Request $request, $id)
{    
    $producto = Producto::find($id);
    $oldImageName = $producto->imagen;
    $uploadedFile = $request->file('imagen');
    if($uploadedFile){
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
    $producto->nombre = $request->nombre;
    $producto->codigo = $request->codigo;    
    $producto->tipo_producto = $request->tipo_producto;
    $producto->pais_destino = $request->pais_destino;
    $producto->ciudad_destino = $request->ciudad_destino;
    $producto->origen_salida = $request->origen_salida;
    $producto->transporte = $request->transporte;
    $producto->precio_total = $request->precio_total;
    $producto->precio_comisionable = $request->precio_comisionable;
    $producto->hotel = $request->hotel;
    $producto->categoria_hotel = $request->categoria_hotel;
    $producto->duracion = $request->duracion;
    $producto->solo_adultos = $request->solo_adultos;
    
    $producto->save();
    }
    return redirect('/read_producto')->with('success', 'EL PRODUCTO SE EDITO CORRECTAMENTE !!!');
}

public function createProd(Request $request)
{       
    $this->validate($request, [
        'nombre' => 'string',
        'codigo' => 'unique:productos,codigo',
        'imagen' => 'image|mimes:jpeg,png,jpg|max:2048',
        'tipo_producto' => 'string',
        'pais_destino' => 'string',
        'ciudad_destino' => 'string',
        'origen_salida' => 'string',
        'transporte' => 'string',
        'precio_total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
        'precio_comisionable' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
        'hotel' => 'string',
        'categoria_hotel' => 'integer',
        'duracion' => 'integer',
        'solo_adultos' => 'string',
    ]);
    $uploadedFile = $request->file('imagen');
    $timestamp = time();
    $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();
                        
    $image = Image::make($uploadedFile);
        
    $extension = strtolower($uploadedFile->getClientOriginalExtension());
     if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {                         
                        Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
                        return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
    } else {
        //dd('Tengo la extension correcta');
    $image->save(public_path('assets/img_paquetes/' . $originalFileName));
    // Guardar el producto en la base de datos
    $producto = new Producto;
    $producto->nombre = $request->nombre;
    $producto->codigo = $request->codigo;
    $producto->imagen = $originalFileName;
    $producto->tipo_producto = $request->tipo_producto;
    $producto->pais_destino = $request->pais_destino;
    $producto->ciudad_destino = $request->ciudad_destino;
    $producto->origen_salida = $request->origen_salida;
    $producto->transporte = $request->transporte;
    $producto->precio_total = $request->precio_total;
    $producto->precio_comisionable = $request->precio_comisionable;
    $producto->hotel = $request->hotel;
    $producto->categoria_hotel = $request->categoria_hotel;
    $producto->duracion = $request->duracion;
    
    $producto->solo_adultos = $request->has('solo_adultos') ? true : false;

    //dd($producto);
    $producto->save();
    }
    return redirect('/read_producto')->with('success', 'EL PRODUCTO SE CREÓ CORRECTAMENTE');
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
