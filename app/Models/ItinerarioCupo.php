<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioCupo extends Model
{
    use HasFactory;
    protected $table = 'itinerario_cupos';
    protected $fillable = [
        'num_vuelo',
        'aerolinea_id',        
        'origen',
        'destino',
        'hora_salida',
        'hora_llegada',        
        'fecha_salida',
        'fecha_llegada', 
    ];

    public function aerolinea()
{
    return $this->belongsTo(Aerolinea::class, 'aerolinea_id');
}
}