<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos'; // Especifica el nombre de la tabla

    protected $fillable = [
        'client_id',
        'mis_viajes_id',
        'total_viaje',
        'monto_pagado',
        'tipo_pago',
        'numero_cuota',
        'fecha_pago',
        'metodo_pago',
        'comprobante',
        'estado',
        'saldo_pendiente',
    ];
   
    public function misViaje()
    {
    return $this->belongsTo(MisViaje::class, 'mis_viajes_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
   
}