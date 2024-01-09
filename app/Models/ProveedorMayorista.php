<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pais;


class ProveedorMayorista extends Model
{
    use HasFactory;
    protected $table = 'proveedores_mayoristas';
    protected $fillable = [
    'empresa', 'contacto', 'direccion', 'telefono' ,'email', 'localidad', 'provincia', 'pais'];

        
}
