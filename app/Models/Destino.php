<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
     protected $fillable = [
        'nombre_destino',
        'id_pais',
        'detalle_gral',
        'ubicacion',
        'playas',
        'gastronomia',
        'atracciones',
        'historia',
        'resumen',
        'img_banner',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
        'img6',
        'img7',
        'img8',
        'img9',
        'img10',
    ];   

}
