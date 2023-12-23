<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;
use App\Models\Pais;
use Intervention\Image\Facades\Image;

class DestinoController extends Controller
{
     public function mostrarDestinos()
    {       
        $destinos = Destino::all();
        return view('productos.destinos.read_destinos', compact('destinos'));
    }
    public function showFormDestino()
    {       
        $destinos = Destino::all();
        $paises = Pais::all();
        return view('productos.destinos.create_destino', compact('destinos', 'paises'));
    }
    public function createDestino(Request $request)
    {
        dd($request->all());
         $request->validate([
         'nombre_destino' => 'string',
         'id_pais' => 'integer',
         'detalle_gral' => 'string',
         'ubicacion' => 'string',         
         'playas' => 'string',
         'gastronomia' => 'string',
         'atracciones' => 'string',
         'historia' => 'string',         
         'resumen' => 'string',
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
        $image->save(public_path('assets/img_destinos/' . $originalFileName));
        $destino = new Destino;
        $destino->nombre_destino = $request->nombre_destino;
        $destino->id_pais = $request->id_pais;
        $destino->detalle_gral = $request->detalle_gral;
        $destino->ubicacion = $request->ubicacion;
        $destino->playas = $request->playas;
        $destino->gastronomia = $request->gastronomia;
        $destino->atracciones = $request->atracciones;
        $destino->historia = $request->historia;
        $destino->resumen = $request->resumen;        
        $destino->img_banner = $originalFileName;
        
        $destino->save();
        
      if ($request->hasFile('imagenes')) {
           $index = 1;
           foreach ($uploadedFiles as $imagen) {
            $destinationPath = public_path('assets/img_destinos/');
            $imagenPath = $imagen->getClientOriginalName();

            $imageSecundaria = Image::make($imagen);
            $imageSecundaria->save($destinationPath . $imagen->getClientOriginalName());

            $destino->setAttribute('img' . $index, $imagenPath);

            $index++;
        }
        $destino->save();
    }
        } 
      
    }
}
