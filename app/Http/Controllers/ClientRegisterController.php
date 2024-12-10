<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyEmailClient;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ClientRegisterController extends Controller
{
    public function register(ClientRequest $request)
    {             
        $validatedData = $request->validated();
        $userId = $request->cookie('promotor_ventas'); 
        foreach ($validatedData as $field => $value) {
        if ($field !== 'email') {
            $validatedData[$field] = ucwords(strtolower($value));
        }
    }
        try {            
            $client = Client::create($validatedData);
            if ($userId) {
            $client->fk_users_id  = $userId;
            $client->save();
            } else {
            $userId = 1;
            $client->fk_users_id  = $userId;
            $client->save();
            }
        } catch (QueryException $e) {
            if (strpos($e->getMessage(), 'clients_usuario_unique') !== false || strpos($e->getMessage(), 'clients_email_unique') !== false) {
                return redirect()->back()->withErrors(['error' => 'El usuario o el correo electrónico ya existen'])->withInput();
            }
        }
        $client->notify(new VerifyEmailClient($client->id));
        return redirect('/bienvenidos');
    }
    public function verification()
    {
        return view('client.verification_success');
    }
    public function show()
    {
        if (Auth::check()) {
            return redirect('/userHome');
        }
        return view('client.register_client');
    }
    public function editForm()
    {
        $client = Auth::user(); // Obtener el usuario autenticado
        $paises = Pais::all();
        $provincias = Provincia::all();
        $id_pais = $client->provincia->id_pais ?? null;
        $codigo_pais = $client->pais->cod_pais ?? null;
        $nombre_pais = $client->pais->nombre ?? null;
        $nombre_img = $client->pais->nombre_img ?? null;
        return view('client.edit_client', compact('client', 'paises', 'provincias', 'id_pais', 'codigo_pais', 'nombre_pais', 'nombre_img')); // Pasar la variable $user a la vista
    }

    public function update(Request $request, $id)
    {
        try {            
        $client = Client::findOrFail($id);

        $request->validate([
        'email' => 'nullable|unique:clients,email,' . $id, 
        'password' => 'nullable|min:8',
        'password_confirmation_edit' => 'required_with:password|same:password',
        
        ]);

       if ($request->filled('email')) {
        $client->email = $request->input('email');
       }
       if ($request->filled('password')) {
        $newPassword = $request->input('password');
        $client->updatePassword($newPassword);
       }
       
        $client->nombre = ucwords(strtolower($request->input('nombre')));
        $client->apellido = ucwords(strtolower($request->input('apellido')));
        $client->movil = $request->input('movil');
        $client->ciudad = ucwords(strtolower($request->input('ciudad')));
        $client->provincia = ucwords(strtolower($request->input('provincia')));
        $client->pais = ucwords(strtolower($request->input('pais')));
          
        $client->save();       
        
       }catch (QueryException $e) {
            if (strpos($e->getMessage(), 'clients_email_unique') !== false) {
                return redirect()->back()->withErrors(['error' => 'El correo electrónico ya existe'])->withInput();
            }
        }
        // Redireccionar a la página de edición o mostrar un mensaje de éxito
        return redirect()->route('client.edit')->with('success', 'Sus datos se actualizaron correctamente!!!');
    }
    public function verifyEmail(Request $request, $id)
    {
        // Buscar al usuario por su ID
        $client = Client::find($id);

        if (!$client) {
            abort(404, 'User not found'); // O maneja el caso en el que el usuario no se encuentre.
        }

        // Verificar la firma temporal de la URL
        if (!hash_equals(sha1($client->getEmailForVerification()), $request->hash)) {
            abort(403, 'Unauthorized'); // O maneja el error de URL no válida de acuerdo a tus necesidades.
        }

        // Verificar si el usuario ya ha verificado su correo electrónico
        if ($client->hasVerifiedEmail()) {
            return redirect('/'); // O redirige al usuario a la página de inicio u otra que desees.
        }

        // Marcar el correo electrónico como verificado
        $client->markEmailAsVerified();

        return redirect()->route('verification.success'); // O a la página de éxito si tienes una definida.
    }
}