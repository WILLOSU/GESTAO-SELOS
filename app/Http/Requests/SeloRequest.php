<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeloRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => 'required|integer|unique:selos,numero,' . $this->selo?->id,
            'vendedor_id' => 'nullable|exists:vendedores,id',
            'valor_venda' => 'nullable|numeric|min:0',
            'status' => 'required|in:disponivel,vendido,cancelado'
        ];
    }
}
