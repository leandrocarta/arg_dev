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
        'destinoGral',
        'pais_destino',
        'ciudad_destino',
        'origen_salida',
        'precio_total',
        'precio_comisionable',
        'moneda',
        'id_hotel',
        'estadia',
        'id_hotel2',
        'estadia_dos',
        'id_hotel3',
        'estadia_tres',
        'fecha_baja',
        'estadiaTotal',
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


}
