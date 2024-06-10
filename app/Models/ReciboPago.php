<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboPago extends Model
{
    use HasFactory;
    protected $table = 'recibo_pagos';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'concepto',
        'moneda',
        'importe',
        'fecha',
    ];
}
