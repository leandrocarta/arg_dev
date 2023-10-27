<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id',
        'descripcion',
        'itinerario',
        'incluye',
        'no_incluye',
        'requisitos',
        'fechas_disponibles',
        'condiciones',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
