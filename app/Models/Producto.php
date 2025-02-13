<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'titulo',
        'proveedor',
        'fecha_salida',
        'id_hotel',
        'id_destino',
        'id_pais',
        'id_aerolinea',
        'estadia',
        'habitacion',
        'precio_total',
        'descto',
        'moneda',
        'origen_salida',
        'tipo_producto',
        'imagen',
        'detalle',
        'comidas',
        'ubicacion',
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
public function aerolinea()
{
    return $this->belongsTo(Aerolinea::class, 'id_aerolinea'); // Ajusta 'aerolinea_id' si es necesario
}


 /*public function paises()
    {
        return $this->belongsTo(Pais::class, 'id_pais_destino'); 
    } */
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }
}