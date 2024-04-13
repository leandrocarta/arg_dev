<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelsRoom extends Model
{
    use HasFactory;
    protected $table = 'hotels_room';
    protected $fillable = [
        'id_hotel',
        'tipo_room',
        'capacidad_room',
        'detalle',
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
        'moneda',
        'costo_room',        
        'utilidad',
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
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }
}
