<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Intervention\Image\Facades\Image;
use App\Models\Pais;
use App\Models\Destino;
use App\Models\ProveedorMayorista;

class HotelController extends Controller
{
    public function mostrarHoteles()
    {
        $hoteles = Hotel::all();
        $paises = Pais::all();
        $destinos = Destino::all();
        return view('productos.hotel.read_hotel', compact('hoteles', 'paises', 'destinos'));
    }
    public function showFormHotel()
    {
        $ciudades = Destino::all();
        $paises = Pais::all();
        $proveedores = ProveedorMayorista::all();
        return view('productos.hotel.hotel_news', compact('ciudades', 'paises', 'proveedores'));    }

    public function createHotel(Request $request)
    {        
        //dd($request->all());
        $this->validate($request, [
            'nombre' => 'required|string',
            'categoria' => 'required|integer',
            'id_ciudad' => 'required|string',
            'id_pais' => 'required|string',            
            'tipo_publico' => 'required|string',
        ]);
        $uploadedFile = $request->file('img_banner');
        $uploadedFiles = $request->file('imagenes');
        
        $originalFileName = $uploadedFile->getClientOriginalName();
        $image = Image::make($uploadedFile);
        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {
            Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
            return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
        } else {
        $image->save(public_path('assets/img_hoteles/' . $originalFileName));
        // Crea un nuevo hotel en la base de datos
        $hotel = new Hotel;
        $hotel->id_prov = $request->id_prov;
        $hotel->nombre = $request->nombre;
        $hotel->categoria = $request->categoria;
        $hotel->id_ciudad = $request->id_ciudad;
        $hotel->id_pais = $request->id_pais;        
        $hotel->tipo_publico = $request->tipo_publico;
        $hotel->img_banner = $originalFileName;
        $hotel->detalles = $request->detalles;       
        $hotel->save();
        
      if ($request->hasFile('imagenes')) {
           $index = 1;
           foreach ($uploadedFiles as $imagen) {
            $destinationPath = public_path('assets/img_hoteles/');
            $imagenPath = $imagen->getClientOriginalName();

            $imageSecundaria = Image::make($imagen);
            $imageSecundaria->save($destinationPath . $imagen->getClientOriginalName());

            $hotel->setAttribute('img' . $index, $imagenPath);

            $index++;
        }
        $hotel->save();
    }
        } 

        return redirect('/read_hotel')->with('success', 'EL HOTEL SE AGREGÓ CORRECTAMENTE');
    }
    public function formUpdateHotel($id)
    {
        $hotel = Hotel::find($id);
        $ciudades = Destino::all();
        $paises = Pais::all();

        return view('productos.hotel.hotel_update', compact('hotel', 'ciudades', 'paises'));
    }
    public function editarHotel(Request $request, $id)
    {
        $hotel = Hotel::find($id);       
        $hotel->nombre = $request->nombre;
        $hotel->categoria = $request->categoria;
        $hotel->id_ciudad = $request->id_ciudad;
        $hotel->id_pais = $request->id_pais;        
        $hotel->tipo_publico = $request->tipo_publico;
        $hotel->detalles = $request->detalles;

      /*  if ($request->has('wifi')) {
        $hotel->wifi = true; 
        } else {
        $hotel->wifi = false; 
        }
        if ($request->has('gym')) {
        $hotel->gym = true; 
        } else {
        $hotel->gym = false; 
        }
        if ($request->has('spa')) {
        $hotel->spa = true; 
        } else {
        $hotel->spa = false; 
        }
        if ($request->has('parking')) {
        $hotel->parking = true; 
        } else {
        $hotel->parking = false; 
        }
        if ($request->has('traslados')) {
        $hotel->traslados = true; 
        } else {
        $hotel->traslados = false; 
        } */
        $hotel->save();
        return redirect('/read_hotel')->with('success', 'EL HOTEL SE EDITO CORRECTAMENTE !!!');
    }
    public function hotelDelete($id)
    {
        $hotel = Hotel::find($id);

        $hotel->delete();

        return redirect('/read_hotel')->with('success', 'Se ha eliminado el Hotel exitosamente!!!');
    }
}