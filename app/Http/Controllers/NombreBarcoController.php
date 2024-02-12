<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NombreBarco;
use App\Models\Naviera;
use Intervention\Image\Facades\Image;

class NombreBarcoController extends Controller
{
     public function index()
    {
        $barcos = NombreBarco::all();        
        return view('productos.nombre_barcos.read_barcos', compact('barcos'));
    }

     public function showFormNav()
    {
        $navieras = Naviera::all();
        return view('productos.nombre_barcos.create_barco', compact('navieras'));
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'string',
            'naviera' => 'integer',
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
        $image->save(public_path('assets/img_msc/' . $originalFileName));
        $barco = new NombreBarco;
        $barco->nombre = strtoupper($request->nombre);
        $barco->id_naviera  = $request->naviera;
        $barco->img_banner = $originalFileName;

        $barco->save();
        if ($request->hasFile('imagenes')) {
           $index = 1;
           foreach ($uploadedFiles as $imagen) {
            // Define la carpeta de destino y el nombre del archivo
            $destinationPath = public_path('assets/img_msc/');
            $imagenPath = $imagen->getClientOriginalName();

            // Guarda la imagen secundaria
            $imageSecundaria = Image::make($imagen);
            $imageSecundaria->save($destinationPath . $imagen->getClientOriginalName());

            // Guarda la ruta en la columna correspondiente (img_1, img_2, ..., img_10)
            $barco->setAttribute('img' . $index, $imagenPath);

            $index++;
        }
        $barco->save();
    }
        return redirect('/read_barcos')->with('success', 'NAVIERA AGREGADA CORRECTAMENTE');
        }
    }
    
    public function edit($id)
    {
        $barco = NombreBarco::find($id);
        $navieras = Naviera::all();

        return view('productos.nombre_barcos.barco_update', compact('barco', 'navieras'));
    }

    public function update(Request $request, $id)
    {
        $barco = NombreBarco::find($id);

        $barco->nombre = strtoupper($request->nombre);
        $barco->id_naviera  = $request->naviera;

        $barco->save();

        return redirect('/read_barcos')->with('success', 'SE EDITO CORRECTAMENTE !!!');
    }

    public function destroy($id)
    {
        $barco = NombreBarco::find($id);
        $barco->delete();

        return redirect('/read_barcos')->with('success', 'LA NAVIERA SE HA ELIMINADO!!!');
    }
}
