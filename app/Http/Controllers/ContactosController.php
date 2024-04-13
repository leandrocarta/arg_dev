<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientsReclamo;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ReclamoFormMail;

class ContactosController extends Controller
{
    public function showForm()
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user(); // Obtén al cliente autenticado si es necesario
            return view('client.reclamos', compact('client'));
        }
        return view('client.login_client');
    }

    public function reclamo_save(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'nullable|string',
            'email' => 'required|string|email',
            'cod_pais' => 'required|string',
            'movil' => 'required|string',
            'pais' => 'required|string',
            'comentario' => 'required|string',
        ]);
        $clientsReclamo = new ClientsReclamo([
            'id_client' => $id,
            'name' => ucwords(strtolower($request->input('name'))),
            'lastname' => ucwords(strtolower($request->input('lastname'))),
            'email' => strtolower($request->input('email')),
            'cod_pais' => $request->input('cod_pais'),
            'movil' => $request->input('movil'),
            'pais' => ucwords(strtolower($request->input('pais'))),
            'comentario' => $request->input('comentario'),
        ]);
        $clientsReclamo->save();

        $nombre = $request->input('name');
        $apellido = $request->input('lastname');
        $email = $request->input('email');
        $cod_pais = $request->input('cod_pais');
        $movil = $request->input('movil');
        $pais = $request->input('pais');
        $comentario = $request->input('comentario');
        $correoEmpresa = 'reclamos@argtravels.tur.ar';

        if ($id) {
            Mail::to($correoEmpresa)->send(new ReclamoFormMail($id, $nombre, $apellido, $email, $cod_pais, $movil, $pais, $comentario));
        } else {
            Mail::to($correoEmpresa)->send(new ReclamoFormMail(null, $nombre, $apellido, $email, $cod_pais, $movil, $pais, $comentario));
        }
        return redirect()->back()->with('success', 'Su reclamo ha sido recibido con éxito. En breve nos pondremos en contacto para ofrecerle una solución a su solicitud!!!!!');
    }

    public function message(Request $request, $id)
    {
        return redirect()->route('client.reclamos')->with('success', 'Sus datos se actualizaron correctamente!!!');
    }
    public function contactForm()
    {
        return view('client.contacto');
    }
    public function contactAccion(Request $request, $id = null)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $pais = $request->input('pais');
        $comentario = $request->input('comentario');
        $correoEmpresa = 'leandrocarta@gmail.com';

        if ($id) {
            Mail::to($correoEmpresa)->send(new ContactFormMail($id, $nombre, $email, $pais, $comentario));
        } else {
            Mail::to($correoEmpresa)->send(new ContactFormMail(null, $nombre, $email, $pais, $comentario));
        }

        return redirect()->back()->with('success', 'Su consulta ha sido recibida con éxito. En breve nos pondremos en contacto con Usted!!!');
    }
}
