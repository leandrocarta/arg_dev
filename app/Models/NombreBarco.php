<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreBarco extends Model
{
    use HasFactory;
    protected $table = 'nombre_barcos';
    protected $fillable = [
        'id_naviera',
        'nombre',
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

     public function naviera()
    {
        return $this->belongsTo(Naviera::class, 'id_naviera');
    }
     public function productos()
    {
        return $this->hasMany(ProductoCrucero::class, 'id_barco');
    }
}
