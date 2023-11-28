<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
     use HasFactory;
     protected $table = 'cotizacion';
     protected $fillable = [
        'dolar_oficial', 
        'dolar_mep', 
        'dolar_blue'
    ];
    
}
