<?php

namespace App\Http\Controllers;

use App\Models\Aereo;
use App\Models\Producto;
use Illuminate\Http\Request;

class AereosController extends Controller
{
     public function mostrarVuelos()
    {       
        $productos = Producto::all();
        return view('productos.aereos.read_vuelos', compact('productos'));
    }
    public function guardarDatos(Request $request)
    {
        $request->validate([
    'fecha_ida' => 'required|date',
    'fecha_regreso' => 'nullable|date', 
    'origen' => 'required|string',
    'destino' => 'required|string',
    'email' => 'required|email',
    'aclaracion' => 'string',
    'estado' => 'integer',
]);

$aereoData = [
    'fecha_ida' => $request->fecha_ida,
    'origen' => $request->origen,
    'destino' => $request->destino,
    'email' => $request->email,
    'aclaracion' => $request->aclaracion,
    'estado' => 1,
];

// Agregar la fecha de regreso solo si está presente
if ($request->has('fecha_regreso')) {
    $aereoData['fecha_regreso'] = $request->fecha_regreso;
}

Aereo::create($aereoData);

       // return redirect()->route('/home');
         return redirect('/')->with('success', 'Recibimos su consulta, en breve será respondida. Muchas Gracias');
    }
    public function createProd(Request $request)
    {
      //  dd($request->all());
        $messages = [
            'codigo.unique' => 'EL CÓDIGO DEL PRODUCTO INGRESADO YA EXISTE.',
        ];
        $this->validate($request, [
            'nombre' => 'string',
            'codigo' => 'unique:productos,codigo',
            'imagen' => 'image|mimes:jpeg,png,jpg',
            'habitacion' => 'string',
            'tipo_producto' => 'string',
            'destinoGral' => 'string',
            'id_pais_destino' => 'integer',
            'ciudad_destino' => 'integer',
            'origen_salida' => 'string',
            'precio_total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'precio_comisionable' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'moneda' => 'string',
            'hotel_principal' => 'string',
            'estadia_principal' => 'integer',
            'hotel_dos' => 'string',
            'estadia_dos' => 'integer',
            'hotel_tres' => 'string',
            'estadia_tres' => 'integer',
            'fecha_vencimiento' => 'date',
            'estadiaTotal' => 'integer',
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
            $producto->nombre = $request->nombre;
            $producto->codigo = $request->codigo;
            $producto->imagen = $originalFileName;
            $producto->habitacion = $request->habitacion;
            $producto->tipo_producto = $request->tipo_producto;
            $producto->destino_gral = $request->destinoGral;
            $producto->id_pais_destino = $request->pais_destino;
            $producto->id_destino = $request->ciudad_destino;
            $producto->origen_salida = $request->origen_salida;
            $producto->precio_total = $request->precio_total;
            $producto->precio_comisionable = $request->precio_comisionable;
            $producto->moneda = $request->moneda;
            $producto->id_hotel = $request->hotel_principal;
            $producto->estadia = $request->estadia_principal;
            $producto->id_hotel2 = $request->hotel_dos;
            $producto->estadia_dos = $request->estadia_dos;
            $producto->id_hotel3 = $request->hotel_tres;
            $producto->estadia_tres = $request->estadia_tres;
            $producto->fecha_vencimiento = $request->fecha_vencimiento;
            $producto->estadiaTotal = $request->estadiaTotal;

            //$producto->solo_adultos = $request->has('solo_adultos') ? true : false;
            $producto->save();
        }

        return redirect('/read_producto')->with('success', 'EL PRODUCTO SE CREÓ CORRECTAMENTE');
    }
}
