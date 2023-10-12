<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'id_pais'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais', 'cod_pais');
    }
}
