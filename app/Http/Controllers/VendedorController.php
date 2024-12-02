<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\VendedorRequest;

class VendedorController extends Controller
{
    public function index(): JsonResponse
    {
        $vendedores = Vendedor::with('selos')->paginate(10);
        return response()->json($vendedores);
    }

    public function store(VendedorRequest $request): JsonResponse
    {
        $vendedor = Vendedor::create($request->validated());
        return response()->json($vendedor, 201);
    }

    public function show(Vendedor $vendedor): JsonResponse
    {
        return response()->json($vendedor->load('selos'));
    }

    public function update(VendedorRequest $request, Vendedor $vendedor): JsonResponse
    {
        $vendedor->update($request->validated());
        return response()->json($vendedor);
    }

    public function destroy(Vendedor $vendedor): JsonResponse
    {
        $vendedor->delete();
        return response()->json(null, 204);
    }
}
