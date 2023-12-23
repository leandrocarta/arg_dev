<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaisController extends Controller
{    
    public function create()
    {
        $user = auth()->user();
        if ($user && $user->rango === 'director') {
            return view('paises.create');
        } else {
            // Redirigir al usuario a una página de acceso denegado
            return redirect()->to('/login');
        }
    }

    public function store(Request $request)
    {
        //
    }

   
    public function show(Pais $pais)
    {
        //
    }

    public function edit(Pais $pais)
    {
        //
    }

    
    public function update(Request $request, Pais $pais)
    {
        //
    }

    
    public function destroy(Pais $pais)
    {
        //
    }
}
