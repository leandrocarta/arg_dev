<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $table = 'services';
    protected $fillable = [
        'id_prod',
        'transporte_int',
        'traslados_orig',
        'traslados_dest',
        'estadía',
        'comidas',
        'seguro',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
