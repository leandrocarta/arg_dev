<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioCrucero extends Model
{
    use HasFactory;
    protected $table = 'itinerario_crucero';

    protected $fillable = [
        'id_prod',
        'dia1',
        'dia2',
        'dia3',
        'dia4',
        'dia5',
        'dia6',
        'dia7',
        'dia8',
        'dia9',
        'dia10',
        'dia11',
        'dia12',
        'dia13',
        'dia14',
        'dia15',
    ];
}
