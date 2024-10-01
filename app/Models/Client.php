<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Client extends Model implements Authenticatable
{

    use HasApiTokens,
        HasFactory,
        Notifiable,
        MustVerifyEmailTrait;

    public function getAuthIdentifierName()
    {
        return 'id'; // Cambia esto si el nombre de la columna de identificación es diferente
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password; // Cambia esto si el nombre de la columna de contraseña es diferente
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; 
    }
    protected $fillable = [
        'usuario',
        'email',
        'nombre',
        'apellido',
        'movil',
        'ciudad',
        'provincia',
        'pais',
        'password',
        'fk_users_id',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
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
