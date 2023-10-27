<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';

    protected $fillable = [
        'venta_id',
        'user_id',
        'id_vendedor_reclutado',
        'monto_comisionable',
        'comision_1',
        'comision_2',
    ];

    // Definición de las relaciones
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reclutador()
    {
        return $this->belongsTo(User::class, 'id_vendedor_reclutado');
    }
}
