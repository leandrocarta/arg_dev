<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AltaNaviera;

class AltaNavieraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $navieras = AltaNaviera::all();        
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
        $naviera = new AltaNaviera;
        $naviera->naviera = $request->naviera;

        $naviera->save();
        return redirect('/read_naviera')->with('success', 'NAVIERA AGREGADA CORRECTAMENTE');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $naviera = AltaNaviera::find($id);

        return view('productos.navieras.naviera_update', compact('naviera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $naviera = AltaNaviera::find($id);

        $naviera->naviera = $request->naviera;

        $naviera->save();

        return redirect('/read_naviera')->with('success', 'SE EDITO CORRECTAMENTE !!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $naviera = AltaNaviera::find($id);

        $naviera->delete();

        return redirect('/read_naviera')->with('success', 'LA NAVIERA SE HA ELIMINADO!!!');
    }
}
