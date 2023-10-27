<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'imagen',
        'tipo_producto',
        'pais_destino',
        'ciudad_destino',
        'origen_salida',
        'transporte',
        'precio_total',
        'precio_comisionable',
        'hotel',
        'categoria_hotel',
        'duracion',
        'solo_adultos',
    ];
    
}
