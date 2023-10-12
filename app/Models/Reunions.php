<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'pais',
        'id_user_lider',
        'fecha_presentacion',
    ];
}
