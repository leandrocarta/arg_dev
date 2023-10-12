<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsReclamo extends Model
{
    use HasFactory;
    protected $table = 'clients_reclamos';

    protected $fillable = [
        'id_client',
        'name',
        'lastname',
        'email',
        'cod_pais',
        'movil',
        'pais',
        'comentario',
    ];
}
