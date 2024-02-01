<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCrucero extends Model
{
    use HasFactory;
    protected $table = 'productos_cruceros';
    protected $fillable = [
        'destino',
        'fecha_partida',
        'imagen',
        'estadia',
        'puerto_salida',
        'naviera',
        'nombre_barco',
        'tipo_cabina',
        'detalle',
        'moneda',
        'precio',
    ];
}
