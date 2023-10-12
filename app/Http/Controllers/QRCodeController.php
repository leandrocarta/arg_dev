<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
   public function generateQRCode()
{
   // $url = "https://www.argtravels.tur.ar/welcome_suppliers"; // Reemplaza con la URL que desees codificar
         $url = "https://api.whatsapp.com/send?phone=543413672066";
         $qrCode = QrCode::size(400)
        ->merge('assets/img/valija.png', .3, true)
        ->style('round')
        ->eyeColor(0, 176, 151, 46, 46, 151, 177)
        ->generate($url);
      //  QrCode::format('png')->merge('assets/img/valija.png', .3, true)->generate($url);

    return view('qr.qrcode', compact('qrCode'));
}
}
