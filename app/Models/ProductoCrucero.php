<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCrucero extends Model
{
    use HasFactory;
    protected $table = 'productos_cruceros';
    protected $fillable = [
        'id_naviera',
        'id_barco',
        'destino',
        'entre_fechas',
        'fecha_partida',
        'img_banner',
        'imagen',
        'estadia',
        'puerto_salida',        
        'tipo_cabina',
        'detalle',
        'moneda',
        'precio',
        'destino_gral',
    ];
     public function itinerarios()
    {
        return $this->hasOne(ItinerarioCrucero::class, 'id_prod');
    }
    public function naviera()
    {
        return $this->belongsTo(Naviera::class, 'id_naviera');
    }
    public function barco()
    {
        return $this->belongsTo(NombreBarco::class, 'id_barco');
    }
    
}
