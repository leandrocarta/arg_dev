<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Producto;

class PromocionController extends Controller
{
    public function cookie_conoceArgentina(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.conoce_argentina.conoce-argentina', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) { 
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.conoce_argentina.conoce-argentina', compact('productos'))
                ->withCookie($cookie);
        }
    }

    public function cookie_brasil(Request $request)
    {       
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.conoce_america.brasil', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.conoce_america.brasil', compact('productos'))
                ->withCookie($cookie);
        }
    }
     public function cookie_caribe(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.caribe.caribe', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.caribe.caribe', compact('productos'))
                ->withCookie($cookie);
        }
    }
    public function cookie_europa(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.conoce_europa.europa', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.conoce_europa.europa', compact('productos'))
                ->withCookie($cookie);
        }
    }

   public function cookie_porElMundo(Request $request)
    {
        //$productos = Producto::all();
       // $productos = Producto::where('pais_destino', 'Argentina')->get();
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.mundo.por-el-mundo', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.mundo.por-el-mundo', compact('productos'))
                ->withCookie($cookie);
        }
    }

    public function cookie_vuelos(Request $request)
    {       
        $productos = Producto::with(['hotel', 'service', 'itinerario','destinos'])->get();
        if ($request->hasCookie('comercioAdherido')) {
            $userId = $request->cookie('comercioAdherido');
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            /*  $elim_cookie = 'promotorOficialVerificado';
             setcookie($elim_cookie, '', time() - 3600, '/');
             dd('se elimino la cookie: ', $userId);*/
            return view('productos.aereos.aereos', compact('productos'));
        } else {
            $userId = $request->query('comercioAdherido') ?? 1;
            $user = User::find($userId);
            if (!$user) {
                $userId = 1;
            }
            $cookie = cookie('comercioAdherido', $userId, 60 * 24 * 30 * 12);
            $cliente = auth()->guard('client')->user();
            if ($cliente && $cliente->fk_users_id === null) {
                $cliente->fk_users_id = $userId;
                try {
                    $cliente->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            return response()
                ->view('productos.aereos.aereos', compact('productos'))
                ->withCookie($cookie);
        }
    }   
    }

