<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisneyController extends Controller
{
    public function disneyUSA()
    {
        return view('disney.disney-usa');
    }

    public function eurodisney()
    {
        return view('disney.eurodisney');
    }
}
