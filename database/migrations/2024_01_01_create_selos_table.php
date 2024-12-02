<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('selos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->foreignId('vendedor_id')->nullable()->constrained();
            $table->decimal('valor_venda', 10, 2)->nullable();
            $table->timestamp('data_venda')->nullable();
            $table->string('status')->default('disponivel');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selos');
    }
};
