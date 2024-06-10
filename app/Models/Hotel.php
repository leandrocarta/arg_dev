<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
   protected $fillable = [
        'nombre',         
        'categoria',
        'id_ciudad',
        'id_pais',
        'tipo_publico',
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
        'detalles',
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
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }
    public function destino()
    {
        return $this->belongsTo(Destino::class, 'id_ciudad');
    }
}
