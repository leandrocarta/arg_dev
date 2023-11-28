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
        'habitacion',
        'tipo_producto',
        'pais_destino',
        'ciudad_destino',
        'origen_salida',
        'precio_total',
        'precio_comisionable',
        'moneda',
        'id_hotel',
        'estadia',
        'fecha_baja',
    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }
}
