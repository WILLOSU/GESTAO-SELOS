<?php

use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Conexão com o banco de dados bem-sucedida!";
    } catch (\Exception $e) {
        return "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
});

