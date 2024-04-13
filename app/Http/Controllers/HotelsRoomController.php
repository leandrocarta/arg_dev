<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelsRoom;
use App\Models\Hotel;
use Intervention\Image\Facades\Image;

class HotelsRoomController extends Controller
{
      public function index()
    {
        $hoteles = Hotel::all();
        return view('productos.hotel.create_room_hotel', compact('hoteles'));
    }
    public function read_rooms()
    {
        $hoteles = Hotel::all();      
        $rooms = HotelsRoom::all(); 
        return view('productos.hotel.read_rooms', compact('hoteles', 'rooms'));
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'hotel_id' => 'integer',
            'tipo_habitacion' => 'string',        
            'capacidad' => 'string',     
            'detalle' => 'string',
            'moneda' => 'string',
            'costo' => 'integer',
            'utilidad' => 'integer',
        ]);
        $uploadedFiles = $request->file('imagenes');
       
        $room = new HotelsRoom;
        $room->id_hotel   = $request->hotel_id;
        $room->tipo_room = strtoupper($request->tipo_habitacion);  
        $room->capacidad  = $request->capacidad;
        $room->detalle  = $request->detalle;
        $room->moneda  = $request->moneda;
        $room->costo_room  = $request->costo;        
        $room->utilidad  = $request->utilidad;
        $room->save();
        if ($request->hasFile('imagenes')) {
           $index = 1;
           foreach ($uploadedFiles as $imagen) {
            // Define la carpeta de destino y el nombre del archivo
            $destinationPath = public_path('assets/img_room/');
            $imagenPath = $imagen->getClientOriginalName();

            // Guarda la imagen secundaria
            $imageSecundaria = Image::make($imagen);
            $imageSecundaria->save($destinationPath . $imagen->getClientOriginalName());

            // Guarda la ruta en la columna correspondiente (img_1, img_2, ..., img_10)
            $room->setAttribute('img' . $index, $imagenPath);
            $index++;
        }
        $room->save();
    }
        return redirect('/read_rooms')->with('success', 'SE CREO LA HABITACION CORRECTAMENTE');
        
    }
    public function edit_form($id)
    {
        

       // return view('productos.hotel.room_update', compact('barco', 'navieras'));
    }
     public function destroy($id)
    {
        $room = HotelsRoom::find($id);
        $room->delete();

        return redirect('/read_rooms')->with('success', 'LA HABITACION SE HA ELIMINADO!!!');
    }
}
