<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;

class ExcursionesArgController extends Controller
{
    public function create()
    {
        $provincias = Provincia::all();
        return view('productos.excursiones.argentina.excursiones_arg', compact('provincias'));
    }
}
