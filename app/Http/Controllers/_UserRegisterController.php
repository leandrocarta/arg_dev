<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Rango;
use App\Notifications\VerifyEmailUser;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;



class UserRegisterController extends Controller
{        
    public function welcome()
    {
        return view('bienvenidos');
    }    

     public function the_club()
    {
        return view('the_club');
    }    

    public function show()
    {
        if (Auth::check()) {
            return redirect('/userHome');
        }
        return view('user.register_emprendedor_digital');
    }
    public function register(UserRequest $request)
    {
        if ($request->hasCookie('reclutador_equipo_oficial')) {             
             $userId = $request->cookie('reclutador_equipo_oficial');
             $user = User::find($userId); 
         } else {    
           $userId = $request->query('reclutador_equipo_oficial') ?? 1;  
           $user = User::find($userId); 
           if (!$user) {
           $userId = 1;
           $user = User::find(1);
           }            
           $cookie = cookie('reclutador_equipo_oficial', $userId, 60 * 24 * 30 * 12); 
          }     
    
        $user = User::create($request->except('link_mundo', 'link_argtravels', 'link_sumate', 'comision', 'regalia'));

        $user->id_user_lider = $userId;
        $user->save();

        $urlMundo = 'www.argtravels.tur.ar/?=';
        $linkMundo = $urlMundo . $user->id;       
        $user->link_mundo = $linkMundo;
        $user->save();

        $urlArgTravels = 'www.argtravels.tur.ar/disney?promotor_ventas=';
        $linkArgTravels = $urlArgTravels . $user->id;
        $user->link_argtravels = $linkArgTravels;
        $user->save();

        $urlEquipo = 'www.argtravels.tur.ar/lider_equipo?reclutador=';
        $link_sumate = $urlEquipo . $user->id;
        $user->link_sumate = $link_sumate;
        $user->save();
                
        $comision = 4;
        $user->comision = $comision;
        $user->save();

        $regalia = 1;
        $user->regalia = $regalia;
        $user->save();
        // Enviar la notificación de verificación por correo electrónico
        $user->notify(new VerifyEmailUser($user->id));
        return redirect('/bienvenidos');
    }
    public function verification()
    {
        return view('user.verification_success');
    }

    public function verifyEmail(Request $request, $id)
    {       
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found'); 
        }
        
        if (!hash_equals(sha1($user->getEmailForVerification()), $request->hash)) {
            abort(403, 'Unauthorized'); 
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/'); 
        }

        $user->markEmailAsVerified();
        return redirect()->route('verificacion.success');
    }

    public function editForm()
    {
        $user = Auth::user(); 
        $paises = Pais::all();
        $provincias = Provincia::all();
        $rangos = Rango::all();
        $id_pais = $user->provincia->id_pais ?? null;
        $codigo_pais = $user->pais->cod_pais ?? null;
        $nombre_pais = $user->pais->nombre ?? null;
        $nombre_img = $user->pais->nombre_img ?? null;
        return view('user.edit', compact('user', 'paises', 'provincias', 'rangos', 'id_pais', 'codigo_pais', 'nombre_pais', 'nombre_img')); // Pasar la variable $user a la vista
    }
    public function update(Request $request, $id)
    {
        $request->validate([
       // 'email' => 'nullable|unique:users,email,' . $id, 
        'password' => 'nullable|min:8',
        'password_confirmation_edit' => 'required_with:password|same:password',
        
        ]);
        $user = User::findOrFail($id);
        if (Auth::user()->img_profile === '' || Auth::user()->img_profile === null) {                        
            try {    
                $uploadedFile = $request->file('profile_image');
                if ($uploadedFile) {                   
                    $extension = strtolower($uploadedFile->getClientOriginalExtension());
                    if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {                         
                        Session::flash('error_message', 'Ooops10!!! Hubo un error, revisa el formulario.');
                        return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
                    } else {                         
                        $timestamp = time();
                        $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();                        
                        $image = Image::make($uploadedFile);
                        
                        if ($image->width() > 500 || $image->height() > 500) {
                            $image->fit(500, 500);
                        } else {
                            $image->fit(500, 500);
                        }
                        $image->save(public_path('assets/img_profile/' . $originalFileName));

                        if ($request->filled('email')) {
                          $user->email = $request->input('email');
                         }
                         if ($request->filled('password')) {
                          $newPassword = $request->input('password');
                          $user->updatePassword($newPassword);
                         }
                        
                        $user->img_profile = $originalFileName;
                        $user->comision = 4.00;
                        $user->regalia = 1.00;
                        $user->nombre = $request->input('nombre');
                        $user->apellido = $request->input('apellido');
                        $user->dni_select = $request->input('dni_select');
                        $user->dni_num = $request->input('dni_num');
                        $user->movil_area = $request->input('cod_area');
                        $user->movil_num = $request->input('movil');

                        $user->direccion = $request->input('direccion');
                        $user->ciudad = $request->input('ciudad');
                        $user->id_provincia = $request->input('provincia');
                        $user->id_pais = $request->input('pais');
                        $user->id_rango = $request->input('rango');
                        $user->save();
                    }
                } else {
                    Session::flash('error_message', 'Ooops!!! Hubo un error, revisa el formulario, pero debes subir una imagen de perfil en la primera actualización.');
                    return back()->withErrors(['profile_image' => 'Debes seleccionar una imagen de perfil.']);
                }
            } catch (\Exception $e) {
                dd('Viene sin IMG y es Obligatoria: ERROR!!');
                Session::flash('error_message', 'Ooops Ooops !!! Hubo un error, revisa el formulario.');
            }
        } else {
            try {
                $uploadedFile = $request->file('profile_image');
                $oldImageName = $user->img_profile;
                if ($uploadedFile) {
                    $extension = strtolower($uploadedFile->getClientOriginalExtension());
                    if (!in_array($extension, ['jpeg', 'jpg', 'png'])) {
                        Session::flash('error_message', 'Ooops!!! Hubo un error, revisa el formulario.');
                        return back()->withErrors(['profile_image' => 'El archivo debe ser una imagen JPEG, JPG o PNG.']);
                    } else {
                        if ($oldImageName) {
                           $oldImagePath = public_path('assets/img_profile/' . $oldImageName);
                           if (file_exists($oldImagePath)) {
                               unlink($oldImagePath);
                            }
                        }
                        $timestamp = time();
                        $originalFileName = $timestamp . '_' . $uploadedFile->getClientOriginalName();
                        $image = Image::make($uploadedFile);
                        if ($image->width() > 500 || $image->height() > 500) {
                            $image->fit(500, 500);
                        } else {
                            $image->fit(500, 500);
                        }
                        $image->save(public_path('assets/img_profile/' . $originalFileName), 99);
                        $user->img_profile = $originalFileName;
                       // $user->save();
                        $user->comision = $request->input('comision');
                        
                        $user->regalia = $request->input('regalia');
                        $regalia = $request->input('regalia');
                        if ($regalia === null || $regalia === '') {
                        $regalia = 1.00;
                        $user->regalia = $regalia;
                        }
                        if ($request->filled('email')) {
                          $user->email = $request->input('email');
                         }
                         if ($request->filled('password')) {
                          $newPassword = $request->input('password');
                          $user->updatePassword($newPassword);
                         }
                        $user->comision = 4.00;
                        $user->regalia = 1.00;
                        $user->nombre = $request->input('nombre');
                        $user->apellido = $request->input('apellido');
                        $user->dni_select = $request->input('dni_select');
                        $user->dni_num = $request->input('dni_num');
                        $user->movil_area = $request->input('cod_area');
                        $user->movil_num = $request->input('movil');

                        $user->direccion = $request->input('direccion');
                        $user->ciudad = $request->input('ciudad');
                        $user->id_provincia = $request->input('provincia');
                        $user->id_pais = $request->input('pais');
                        $user->id_rango = $request->input('rango');
                        $user->save();
                        return redirect()->route('user.edit')->with('success', 'Tus datos se actualizaron correctamente!!!');
                    }
                } else {                                       
                    $user->comision = $request->input('comision');                    
                    $user->regalia = $request->input('regalia');
                    $regalia = $request->input('regalia');
                    if ($regalia === null || $regalia === '') {
                    $regalia = 1.00;
                    $user->regalia = $regalia;
                    }
                    if ($request->filled('email')) {
                          $user->email = $request->input('email');
                         }
                         if ($request->filled('password')) {
                          $newPassword = $request->input('password');
                          $user->updatePassword($newPassword);
                         }
                         $user->comision = 4.00;
                        $user->regalia = 1.00;
                    $user->nombre = $request->input('nombre');
                    $user->apellido = $request->input('apellido');
                    $user->dni_select = $request->input('dni_select');
                    $user->dni_num = $request->input('dni_num');
                    $user->movil_area = $request->input('cod_area');
                    $user->movil_num = $request->input('movil');

                    $user->direccion = $request->input('direccion');
                    $user->ciudad = $request->input('ciudad');
                    $user->id_provincia = $request->input('provincia');
                    $user->id_pais = $request->input('pais');
                    $user->id_rango = $request->input('rango');
                    $user->save();
                }
            } catch (\Exception $e) {
                // Manejar el error general  
                Session::flash('error_message', 'Ooops, se produjo en error.');
            }
        }
        return redirect()->route('user.edit')->with('success', 'Sus datos se actualizaron correctamente!!!');
    }

    public function destroy(string $id)
    {
        //
    }
    public function update2(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $user->nombre = $request->input('nombre');
            $user->apellido = $request->input('apellido');
            $user->dni_select = $request->input('dni_select');
            $user->dni_num = $request->input('dni_num');
            $user->movil_area = $request->input('cod_area');
            $user->movil_num = $request->input('movil');

            $user->direccion = $request->input('direccion');
            $user->ciudad = $request->input('ciudad');
            $user->id_provincia = $request->input('provincia');
            $user->id_pais = $request->input('pais');
            $user->id_rango = $request->input('rango');
            $user->save();
            return redirect()->route('user.edit')->with('success', 'Tus datos se actualizaron correctamente!!!');
        } catch (\Exception $e) {
            // Manejar el error general  
            Session::flash('error_message', 'Ooops, se produjo en error.');
        }
        return redirect()->route('user.edit')->with('success', 'Sus datos se actualizaron correctamente!!!');
    }
}