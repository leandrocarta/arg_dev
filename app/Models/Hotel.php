<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
   protected $fillable = [
        'nombre', 
        'destino',
        'pais',
        'comidas',
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
        'img11',
        'img12',
        'img13',
        'img14',
        'img15',
        'wifi',
        'gym',
        'spa',
        'parking',
        'traslados',
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
