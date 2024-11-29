<?php

namespace App\Services;

use App\Models\Selo;
use App\Models\Vendedor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SeloService
{
    /**
     * Vende um lote de selos para um vendedor
     */
    public function venderSelos(
        Vendedor $vendedor,
        array $numeros,
        float $valorUnitario = 0.0
    ): Collection {
        // Validar se vendedor está ativo
        if (!$vendedor->podeComprarSelos()) {
            throw new InvalidArgumentException(
                'Vendedor não está ativo para comprar selos.'
            );
        }

        // Validar se os selos existem e estão disponíveis
        $selosDisponiveis = Selo::whereIn('numero', $numeros)
            ->whereNull('vendedor_id')
            ->get();

        if ($selosDisponiveis->count() !== count($numeros)) {
            throw new InvalidArgumentException(
                'Alguns selos não estão disponíveis para venda.'
            );
        }

        // Realizar a venda em uma transação
        return DB::transaction(function () use ($vendedor, $selosDisponiveis, $valorUnitario) {
            return $selosDisponiveis->map(function ($selo) use ($vendedor, $valorUnitario) {
                $selo->update([
                    'vendedor_id' => $vendedor->id,
                    'data_venda' => now(),
                    'valor_venda' => $valorUnitario
                ]);

                return $selo->fresh();
            });
        });
    }

    /**
     * Verifica se um selo pertence a um vendedor
     */
    public function verificarProprietario(int $numeroSelo, int $vendedorId): bool
    {
        $selo = Selo::where('numero', $numeroSelo)->first();

        if (!$selo) {
            throw new InvalidArgumentException('Selo não encontrado.');
        }

        return $selo->pertenceAoVendedor($vendedorId);
    }

    /**
     * Lista selos disponíveis para venda
     */
    public function listarSelosDisponiveis(): Collection
    {
        return Selo::whereNull('vendedor_id')
            ->orderBy('numero')
            ->get();
    }

    /**
     * Lista selos de um vendedor específico
     */
    public function listarSelosVendedor(Vendedor $vendedor): Collection
    {
        return $vendedor->selos()
            ->orderBy('numero')
            ->get();
    }

    /**
     * Busca selos por intervalo de números
     */
    public function buscarSelosPorIntervalo(int $inicio, int $fim): Collection
    {
        return Selo::whereBetween('numero', [$inicio, $fim])
            ->orderBy('numero')
            ->get();
    }
}
