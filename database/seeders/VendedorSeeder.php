<?php

namespace Database\Seeders;

use App\Models\Vendedor;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 10 vendedores
        for ($i = 1; $i <= 10; $i++) {
            Vendedor::create([
                'nome' => "Vendedor {$i}",
                'email' => "vendedor{$i}@exemplo.com",
                'telefone' => "(11) 9999-999{$i}",
                'ativo' => true
            ]);
        }
    }
}
