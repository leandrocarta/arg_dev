<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;


class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        MustVerifyEmailTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'email',
        'password',
        'nombre',
        'apellido',
        'dni_select',
        'dni_num',
        'direccion',
        'ciudad',
        'id_provincia',
        'id_pais',
        'movil_area',
        'movil_num',
        'id_rango',
        'link_mundo',
        'link_argtravels',
        'link_sumate',
        'comision',
        'regalia',
        'id_user_lider',
        'img_perfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function updatePassword($newPassword)
    {        
       $this->password = $newPassword;
    $this->save();
    }
}
