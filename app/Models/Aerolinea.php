<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aerolinea extends Model
{
    use HasFactory;
    // Si el nombre de la tabla no coincide con el plural del modelo, defínelo:
    protected $table = 'aerolinea';

    // Campos que se pueden llenar en el modelo
    protected $fillable = [
        'penalidad',
        'cupos',
        'compania',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id');
    }
    public function itinerarios()
    {
    return $this->hasMany(ItinerarioCupo::class, 'aerolinea_id');
    }

}