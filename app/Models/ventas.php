<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $fillable = [
        'fk_user_id',
        'fk_clients_id',
        'fecha',
        'monto_comisionable',
        'monto_total',
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'fk_clients_id');
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'venta_id');
    }
}
