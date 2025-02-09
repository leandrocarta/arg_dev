<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisViaje extends Model
{
    use HasFactory;

    protected $table = 'mis_viajes'; // Nombre de la tabla
    protected $fillable = [
        'client_id',
        'id_producto',
        'hotel_id',
        'valor_viaje',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'notas'
    ];

    // Relación con la tabla clients
    

public function hotel()
{
    return $this->belongsTo(Hotel::class);
}
/*
public function client()
{
    return $this->belongsTo(Client::class);
} */
public function client()
{
    return $this->belongsTo(Client::class, 'client_id', 'id');
}
   
public function pagos()
{
    return $this->hasMany(Pago::class, 'mis_viajes_id');
}
public function producto()
{
    return $this->belongsTo(Producto::class, 'id_producto', 'id');
}


}