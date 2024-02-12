<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoCrucero;
use App\Models\ItinerarioCrucero;
use App\Models\Naviera;
use App\Models\NombreBarco;
use Intervention\Image\Facades\Image;

class ProductoCruceroController extends Controller
{
     public function mostrarProductos()
    {       
        $productos = ProductoCrucero::all();       
        return view('productos.cruceros.read_crucero', compact('productos'));
    }
    public function showFormCru()
    {
        $navieras = Naviera::all(); 
        $barcos = NombreBarco::all(); 
        return view('productos.cruceros.create_crucero', compact('navieras', 'barcos'));
    }
    
    public function edit($id)
    {
        $producto = ProductoCrucero::with('itinerarios')->find($id);
        $navieras = Naviera::all(); 
        $barcos = NombreBarco::all(); 

        return view('productos.cruceros.crucero_update', compact('producto', 'navieras', 'barcos'));
    } 
    public function update(Request $request, $id)
    {    
         $producto = ProductoCrucero::find($id);
         $itinerario = ItinerarioCrucero::where('id_prod', $producto->id)->first();
        // dd("ID Iti: " . $id);
         $this->validate($request, [
            'id_naviera' => 'integer',
            'id_barco' => 'integer',
            'destino' => 'string',
            'fecha_partida' => 'date',
            'imagen' => 'image|mimes:jpeg,png,jpg',
            'estadia' => 'integer',
            'puerto_salida' => 'string',
            'tipo_cabina' => 'string',
            'detalle' => 'string',
            'moneda' => 'string',
            'precio' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',    
        ]);
         $uploadedFile = $request->file('imagen');
        if($uploadedFile){
            
            $oldImageName = $producto->imagen;
        if ($oldImageName) {
            $oldImagePath = public_path('assets/img_cruceros/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        } 

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
                    $image->save(public_path('assets/img_cruceros/' . $originalFileName));
                    $producto->imagen = $originalFileName;

                    $producto->save();                        
                   }
          } else {
            $producto->id_naviera = $request->id_naviera;
            $producto->id_barco = $request->id_barco;           
            $producto->destino = strtoupper($request->destino);
            $producto->fecha_partida = $request->fecha_partida;                    
            $producto->estadia = $request->estadia;
            $producto->puerto_salida = $request->puerto_salida;
            $producto->tipo_cabina = $request->tipo_cabina;
            $producto->detalle = $request->detalle;
            $producto->moneda = $request->moneda;
            $producto->precio = $request->precio;

            $producto->save(); 
            if ($itinerario) {
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
           
            $itinerario->save();
            }else {
                $itinerarioNuevo = new ItinerarioCrucero;
            $itinerarioNuevo->dia1 = $request->input('dia1');
            $itinerarioNuevo->dia2 = $request->input('dia2');
            $itinerarioNuevo->dia3 = $request->input('dia3');
            $itinerarioNuevo->dia4 = $request->input('dia4');
            $itinerarioNuevo->dia5 = $request->input('dia5');
            $itinerarioNuevo->dia6 = $request->input('dia6');
            $itinerarioNuevo->dia7 = $request->input('dia7');
            $itinerarioNuevo->dia8 = $request->input('dia8');
            $itinerarioNuevo->dia9 = $request->input('dia9');
            $itinerarioNuevo->dia10 = $request->input('dia10');
            $itinerarioNuevo->dia11 = $request->input('dia11');
            $itinerarioNuevo->dia12 = $request->input('dia12');
            $itinerarioNuevo->dia13 = $request->input('dia13');
            $itinerarioNuevo->dia14 = $request->input('dia14');
            $itinerarioNuevo->dia15 = $request->input('dia15');
           
            $itinerarioNuevo->id_prod = $producto->id;
            $itinerarioNuevo->save();
          }       
        }
        return redirect('/read_crucero')->with('success', 'EL PRODUCTO SE EDITO CORRECTAMENTE');
    }

    public function create(Request $request)
    {
       // dd($request->all());
         $this->validate($request, [
            'id_naviera' => 'integer',
            'id_barco' => 'integer',
            'destino' => 'string', 
            'entre_fechas' => 'string',
            'fecha_partida' => 'date',
            'imagen' => 'image|mimes:jpeg,png,jpg',
            'estadia' => 'integer',
            'puerto_salida' => 'string',
            'tipo_cabina' => 'string',
            'detalle' => 'string',
            'moneda' => 'string',
            'precio' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',    
        ]);
        $timestamp = time();
        $uploadedFile_banner = $request->file('img_banner');         
        $uploadedFile_imagen = $request->file('imagen');
        $originalFileName_banner = $timestamp . '_' . $uploadedFile_banner->getClientOriginalName();
        $originalFileName_imagen = $timestamp . '_' . $uploadedFile_imagen->getClientOriginalName();

        
         $image_banner = Image::make($uploadedFile_banner);
         $image_imagen = Image::make($uploadedFile_imagen);
        if ($image_banner->width() > 1080) {
            $image_banner->fit(1080, 720);
        } else {
            $image_banner->fit(1080, 720);
        }    
        $extension_banner = strtolower($uploadedFile_banner->getClientOriginalExtension());
        if (!in_array($extension_banner, ['jpeg', 'jpg', 'png'])) {
        Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
        return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
        } else {
        $image_banner->save(public_path('assets/img_cruceros/' . $originalFileName_banner));
        }
        // Procesamiento de la imagen adicional
        if ($image_imagen->width() > 1080) {
         $image_imagen->fit(1080, 720);
        } else {
        $image_imagen->fit(1080, 720);
}    

$extension_imagen = strtolower($uploadedFile_imagen->getClientOriginalExtension());
if (!in_array($extension_imagen, ['jpeg', 'jpg', 'png'])) {
    Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
    return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
} else {
    $image_imagen->save(public_path('assets/img_cruceros/' . $originalFileName_imagen));

            $producto = new ProductoCrucero;
            $producto->id_naviera = $request->id_naviera;
            $producto->id_barco = $request->id_barco;           
            $producto->destino = strtoupper($request->destino);
            $producto->entre_fechas = strtoupper($request->entre_fechas);
            $producto->fecha_partida = $request->fecha_partida;
            $producto->img_banner = $originalFileName_banner;
            $producto->imagen = $originalFileName_imagen; 
            $producto->estadia = $request->estadia;
            $producto->puerto_salida = $request->puerto_salida;
            $producto->tipo_cabina = $request->tipo_cabina;
            $producto->detalle = $request->detalle;
            $producto->moneda = $request->moneda;
            $producto->precio = $request->precio;
            $producto->destino_gral = 'Cruceros';

            $producto->save();            
        }
        $itinerario = new ItinerarioCrucero;
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

        return redirect('/read_crucero')->with('success', 'EL PRODUCTO SE CREÓ CORRECTAMENTE');
    }

   
    public function destroy($id)
    {
        $productos = ProductoCrucero::find($id); 
        $itinerario = ItinerarioCrucero::where('id_prod', $id)->first();

        $oldImageName = $productos->imagen;
        if ($oldImageName) {
            $oldImagePath = public_path('assets/img_cruceros/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        } 

        $productos->delete();

        if ($itinerario) {
            $itinerario->delete();
        }

        return redirect('/read_crucero')->with('success', 'SE HA ELIMINADO!!!');
    }
    public function detalle_producto($id)
{
    $productos = ProductoCrucero::with(['naviera', 'barco'])->find($id);
    return view('productos.detalles.detalles_cruceros', compact('productos'));        
}
}
