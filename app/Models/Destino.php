<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
     protected $fillable = [
        'nombre_destino',
        'pais',
        'detalle_gral',
        'ubicación',
        'playas',
        'gastronomia',
        'atracciones',
        'historia',
        'resumen',
    ];   

}
