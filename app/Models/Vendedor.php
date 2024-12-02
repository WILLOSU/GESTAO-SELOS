<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedor extends Model
{
    use SoftDeletes;

    protected $table = 'vendedores';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    public function selos(): HasMany
    {
        return $this->hasMany(Selo::class);
    }
}
