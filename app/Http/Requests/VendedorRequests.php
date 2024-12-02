<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->vendedor ? $this->vendedor->id : null;

        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:vendedores,email,' . $id,
            'cpf' => 'required|string|size:14|unique:vendedores,cpf,' . $id,
            'telefone' => 'required|string|max:15',
            'ativo' => 'boolean'
        ];
    }
}
