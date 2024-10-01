<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoCursoItaliano extends Model
{
    use HasFactory;
     protected $table = 'contactos_cursos_italiano';

    // Campos que se pueden llenar a través de la asignación masiva
    protected $fillable = [
        'tipo_producto',
        'nombre', 
        'apellido', 
        'email', 
        'tel', 
        'comentario'
    ];
}
