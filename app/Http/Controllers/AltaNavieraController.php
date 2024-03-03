<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naviera;

class AltaNavieraController extends Controller
{   
    public function index()
    {
          $navieras = Naviera::all();        
        return view('productos.navieras.read_naviera', compact('navieras'));
    }

     public function showFormNav()
    {
        return view('productos.navieras.create_naviera');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'naviera' => 'string',
        ]);
        $naviera = new Naviera;
        $naviera->nombre = strtoupper($request->naviera);

        $naviera->save();
        return redirect('/read_naviera')->with('success', 'NAVIERA AGREGADA CORRECTAMENTE');
    }
    
    public function edit($id)
    {
        $naviera = Naviera::find($id);

        return view('productos.navieras.naviera_update', compact('naviera'));
    }

    public function update(Request $request, $id)
    {
        $naviera = Naviera::find($id);

        $naviera->nombre = strtoupper($request->naviera);

        $naviera->save();

        return redirect('/read_naviera')->with('success', 'SE EDITO CORRECTAMENTE !!!');
    }

    public function destroy($id)
    {
         $naviera = Naviera::find($id);

        $naviera->delete();

        return redirect('/read_naviera')->with('success', 'LA NAVIERA SE HA ELIMINADO!!!');
    }
}
