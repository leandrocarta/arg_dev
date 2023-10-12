<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class PromocionController extends Controller
{
    public function cookie_conoceArgentina(Request $request)
{
    // Verificar si la cookie existe
    if ($request->hasCookie('promotorOficialVerificado')) {
        $cookie_id = $request->cookie('promotorOficialVerificado');
        $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->id_user === null) {
                $cliente->id_user = $cookie_id;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
                /* $elim_cookie = 'promotorOficialVerificado';
                setcookie($elim_cookie, '', time() - 3600, '/'); 
                dd('La cookie existia, la guardamos y la borramos, su valor era: ', $cookie_id);*/
            }       
        return view('productos.conoce_argentina.conoce-argentina');
    } else {
        $cookie_id = $request->query('promotorOficialVerificado');        
        if ($cookie_id) {
            $cookie = cookie('promotorOficialVerificado', $cookie_id, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->id_user === null) {
                $cliente->id_user = $cookie_id;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
          return response()->view('productos.conoce_argentina.conoce-argentina')->withCookie($cookie);
        } else {
             return view('productos.conoce_argentina.conoce-argentina');
        }
    }
}

     
}