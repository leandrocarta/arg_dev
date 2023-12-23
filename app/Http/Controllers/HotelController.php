<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Intervention\Image\Facades\Image;

class HotelController extends Controller
{
    public function mostrarHoteles()
    {
        $hoteles = Hotel::all();
        return view('productos.hotel.read_hotel', compact('hoteles'));
    }
    public function showFormHotel()
    {
        return view('productos.hotel.hotel_news');
    }

    public function createHotel(Request $request)
    {        
        $this->validate($request, [
            'nombre' => 'required|string',
            'categoria' => 'required|integer',
            'publico' => 'required|string',
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
        $hotel->nombre = $request->nombre;
        $hotel->categoria = $request->categoria;
        $hotel->publico = $request->publico;
        $hotel->img_banner = $originalFileName;
        $hotel->gym = $request->gym;
        $hotel->spa = $request->spa;
        
        $hotel->save();
        
      if ($request->hasFile('imagenes')) {
           $index = 1;
           foreach ($uploadedFiles as $imagen) {
            // Define la carpeta de destino y el nombre del archivo
            $destinationPath = public_path('assets/img_hoteles/');
            $imagenPath = $imagen->getClientOriginalName();

            // Guarda la imagen secundaria
            $imageSecundaria = Image::make($imagen);
            $imageSecundaria->save($destinationPath . $imagen->getClientOriginalName());

            // Guarda la ruta en la columna correspondiente (img_1, img_2, ..., img_10)
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

        return view('productos.hotel.hotel_update', compact('hotel'));
    }
    public function editarHotel(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        $hotel->nombre = $request->nombre;
        $hotel->categoria = $request->categoria;
        $hotel->publico = $request->publico;

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
