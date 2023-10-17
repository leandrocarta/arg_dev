<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;

class PromocionController extends Controller
{
     public function cookie_conoceArgentina(Request $request)
  {
    if ($request->hasCookie('promotorOficialVerificado')) {
        $userId = $request->cookie('promotorOficialVerificado');
        $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->id_user === null) {
                $cliente->id_user = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }       
             $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
              dd('Se elimina la Cookie: ' . $userId); 
        return view('productos.conoce_argentina.conoce-argentina');
    } else {
        $userId = $request->query('promotorOficialVerificado') ?? 1;   
        $user = User::find($userId);   
        if (!$user) {
        $userId = 1;
        }        
        $cookie = cookie('promotorOficialVerificado', $userId, 60 * 24 * 30 * 12);
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->id_user === null) {
            $cliente->id_user = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
          return response()->view('productos.todos.por-el-mundo')->withCookie($cookie);        
    }
  }

  public function cookie_porElMundo(Request $request)
  {
    if ($request->hasCookie('promotorOficialVerificado')) {
        $userId = $request->cookie('promotorOficialVerificado');
        $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->id_user === null) {
                $cliente->id_user = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
              $elim_cookie = 'promotorOficialVerificado';
              setcookie($elim_cookie, '', time() - 3600, '/');   
              dd('Se elimina la Cookie: ' . $userId);    
        return view('productos.todos.por-el-mundo');
    } else {
        $userId = $request->query('promotorOficialVerificado') ?? 1;   
        $user = User::find($userId);   
        if (!$user) {
        $userId = 1;
        }        
        $cookie = cookie('promotorOficialVerificado', $userId, 60 * 24 * 30 * 12);
        $cliente = auth()->guard('client')->user();
        if ($cliente && $cliente->id_user === null) {
            $cliente->id_user = $userId;
            try {
                $cliente->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
          return response()->view('productos.todos.por-el-mundo')->withCookie($cookie);        
    }
  }     
}