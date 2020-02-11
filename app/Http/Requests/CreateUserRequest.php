<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Role;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:2'],
            'last_name' => ['required', 'min:2'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'role' => ['nullable', 'in:'.implode(',', Role::getlist())],
            'profession' => ['exists:professions,id', 'nullable', 'present'],
            'bio' => ['required', 'min:6'],
            'twitter' => ['nullable', 'present'],
            'skills' => ['array', 'exists:skills,id'],
        ];
    }

    public function messages(){
        return [
            'first_name.required' => 'El campo nombre es obligatorio.',
            'first_name.regex' => 'El campo nombre no es válido.',
            'first_name.min' => 'El campo  nombre debe tener más de 2 caracteres.',
            'last_name.required' => 'El campo primer apellido es obligatorio',
            'last_name.min' => 'El campo primer apellido debe tener más de 2 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.unique' => 'El campo correo electrónico ya pertenece a otro usuario.',
            'email.email' => 'El campo correo electrónico no es válido.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'El campo contraseña debe tener más de 6 caracteres.',
            'role.in' => 'Debes seleccionar un rol válido.',
            'bio.required' => 'El cambo bio es obligatorio.',
            'bio.min' => 'El cambio bio debe tener más de 6 caracteres.',
            'profession.exists' => 'Debes seleccionar una profesión válida.',
            'profession.present' => 'El campo profesión debe estar presente.',
            'twitter.present' => 'El campo nombre de usuario de twitter debe estar presente.',
            'skills.array' => 'El campo habilidades debe tener el formado de lista.',
            'skills.exists' => 'Debes seleccionar una habilidad válida',
        ];
    }

    public function createUser(){
        User::createUser($this->validated());
    }
}
