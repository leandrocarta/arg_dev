<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $table = 'services';
    protected $fillable = [
        'codigo',
        'transporte_int',
        'traslados_orig',
        'traslados_dest',
        'estadía',
        'comidas',
        'seguro',
    ];
}
