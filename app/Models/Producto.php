<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'proveedor',
        'imagen',
        'habitacion',
        'tipo_producto',
        'destino_gral',
        'id_pais_destino',
        'ciudad_destino',
        'origen_salida',
        'precio_total',
        'descto',
        'moneda',
        'detalles',
        'id_hotel',
        'estadia',        
        'fecha_baja',
    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }    
    public function service()
{
    return $this->hasOne(Service::class, 'id_prod', 'id');
}
    public function itinerario()
{
    return $this->hasOne(Service::class, 'id_prod', 'id');
}
 public function destinos()
    {
        return $this->belongsTo(Destino::class, 'id_destino'); 
    }
 public function paises()
    {
        return $this->belongsTo(Pais::class, 'id_pais_destino'); 
    }
}
