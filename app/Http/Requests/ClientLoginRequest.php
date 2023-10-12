<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class ClientLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'usuario' => 'required',
            'password' => 'required',
        ];
    }

    // Nuevo método para determinar las credenciales de inicio de sesión
    public function getLoginCredentials()
    {
        $usuario = $this->get('usuario');
        $credentials = [
            'password' => $this->get('password'),
        ];

        if ($this->isEmail($usuario)) {
            $credentials['email'] = $usuario;
        } else {
            $credentials['usuario'] = $usuario; // Cambia 'username' por el campo real en tu tabla 'clients'
        }

        return $credentials;
    }

    public function isEmail($value)
    {
        $factory = $this->container->make(ValidationFactory::class);
        return !$factory->make(['usuario' => $value], ['usuario' => 'email'])->fails();
    }
}
