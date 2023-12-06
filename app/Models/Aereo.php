<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aereo extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_ida', 
        'fecha_regreso', 
        'origen', 
        'destino', 
        'email',
    ];
}
