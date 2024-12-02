<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Selo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'vendedor_id',
        'valor_venda',
        'data_venda',
        'status'
    ];

    protected $casts = [
        'valor_venda' => 'decimal:2',
        'data_venda' => 'datetime'
    ];

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Vendedor::class);
    }
}
