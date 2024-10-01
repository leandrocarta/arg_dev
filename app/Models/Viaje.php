<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;
    protected $table = 'mis_viajes';
    protected $fillable = [
        'id_cliente', 
        'id_producto', 
        'familias', 
        'adultos', 
        'menores', 
        'edad_menores',
        'habitaciones', 
        'comentario'
    ];
}
