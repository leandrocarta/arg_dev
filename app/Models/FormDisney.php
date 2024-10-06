<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDisney extends Model
{
    use HasFactory;
    protected $fillable = [
        'promotor_ventas',
        'email',
        'name',
        'disney',
        'fecha',
        'contacto',
        'movil',
        'comentario',
    ];
}