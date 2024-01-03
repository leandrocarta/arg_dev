<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViajeAMedida extends Model
{
    use HasFactory;
    protected $table = 'viaje_a_medida';

    protected $fillable = [
        'nombre',
        'email',
        'fecha',
        'dias',
        'destino',
        'adultos',
        'menores',
        'presupuesto',
        'hotel',
        'actividades',
        'salud',
        'itinerario',
        'expectativa',
        'otro',
    ];
}
