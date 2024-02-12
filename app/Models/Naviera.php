<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Naviera extends Model
{
    use HasFactory;
    protected $table = 'navieras';
    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->hasMany(ProductoCrucero::class, 'id_naviera');
    }

    }
