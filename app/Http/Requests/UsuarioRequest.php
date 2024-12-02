<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->usuario ? $this->usuario->id : null;

        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'password' => $this->isMethod('POST') ? 'required|min:6' : 'nullable|min:6',
            'admin' => 'boolean'
        ];
    }
}
