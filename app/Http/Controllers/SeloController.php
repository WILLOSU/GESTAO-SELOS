<?php

namespace App\Http\Controllers;

use App\Models\Selo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SeloRequest;

class SeloController extends Controller
{
    public function index(): JsonResponse
    {
        $selos = Selo::with('vendedor')->paginate(10);
        return response()->json($selos);
    }

    public function store(SeloRequest $request): JsonResponse
    {
        $selo = Selo::create($request->validated());
        return response()->json($selo, 201);
    }

    public function show(Selo $selo): JsonResponse
    {
        return response()->json($selo->load('vendedor'));
    }

    public function update(SeloRequest $request, Selo $selo): JsonResponse
    {
        $selo->update($request->validated());
        return response()->json($selo);
    }

    public function destroy(Selo $selo): JsonResponse
    {
        $selo->delete();
        return response()->json(null, 204);
    }

    public function disponiveis(): JsonResponse
    {
        $selos = Selo::whereNull('vendedor_id')
                     ->where('status', 'disponivel')
                     ->paginate(10);
        return response()->json($selos);
    }

    public function vender(Request $request, Selo $selo): JsonResponse
    {
        $request->validate([
            'vendedor_id' => 'required|exists:vendedores,id',
            'valor_venda' => 'required|numeric|min:0'
        ]);

        $selo->update([
            'vendedor_id' => $request->vendedor_id,
            'valor_venda' => $request->valor_venda,
            'data_venda' => now(),
            'status' => 'vendido'
        ]);

        return response()->json($selo->load('vendedor'));
    }
}
