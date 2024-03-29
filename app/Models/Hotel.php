<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
   protected $fillable = [
        'nombre', 
        'categoria',
        'publico',
        'img_banner',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
        'img6',
        'img7',
        'img8',
        'img9',
        'img10',
        'gym',
        'spa',
    ];
     public function getImagenes()
    {
        $imagenes = [];
        for ($i = 1; $i <= 10; $i++) { 
            $campoImagen = "img" . $i;
            if ($this->$campoImagen) {
                $imagenes[] = $this->$campoImagen;
            }
        }
        return $imagenes;
    }
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_hotel');
    }
}
