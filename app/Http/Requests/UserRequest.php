<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'usuario' => 'required|unique:users,usuario',
            'email' => 'required|unique:users,email',
            'Correo_electrónico' => 'required|same:email',
            'password' => 'required|min:8',
            'del_password' => 'required|same:password',
        ];
    }
}
