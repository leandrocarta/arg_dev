<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactoCursoItaliano;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactoCreado;

class ContactoCursoItalianoController extends Controller
{

    public function index() {}


    public function create()
    {
        return view('contactos.italy');
    }


    public function store(Request $request)
    {
        $contacto = new ContactoCursoItaliano();
        $contacto->tipo_producto = $request->tipo_producto;
        $contacto->nombre = $request->nombre;
        $contacto->apellido = $request->apellido;
        $contacto->correo = $request->correo;
        $contacto->tel = $request->tel;
        $contacto->comentario = $request->comentario;
        $contacto->save();

        // Redireccionar al listado de contactos con un mensaje de éxito
        $contactoData = [
            'tipo_producto' => $request->tipo_producto,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'tel' => $request->tel,
            'comentario' => $request->comentario,
        ];
        // dd('Contacto Data', $contactoData);
        if ($request->tipo_producto === 'Cursos') {
            Notification::route('mail', 'icifunesoficial@gmail.com')
                ->notify(new ContactoCreado($contactoData));
        } elseif ($request->tipo_producto === 'Viaje Idiomático') {
            Notification::route('mail', 'leandrocarta@gmail.com')
                ->notify(new ContactoCreado($contactoData));
        } elseif ($request->tipo_producto === 'Otros destinos') {
            Notification::route('mail', 'leandrocarta@gmail.com')
                ->notify(new ContactoCreado($contactoData));
        } elseif ($request->tipo_producto === 'Cursos y Viajes') {
            Notification::route('mail', 'icifunesoficial@gmail.com')
                ->notify(new ContactoCreado($contactoData));
            Notification::route('mail', 'leandrocarta@gmail.com')
                ->notify(new ContactoCreado($contactoData));
        }
        return redirect('/italy')->with('success', 'Recibimos su consulta, en breve nos pondremos en contacto.');
    }


    public function show(string $id) {}


    public function edit(string $id) {}


    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
