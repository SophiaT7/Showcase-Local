<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        return response()->json($vitrine->servicos()->orderBy('ordem')->get());
    }

    public function store(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $data = $request->validate([
            'nome'        => 'required|string|max:255',
            'descricao'   => 'nullable|string|max:1000',
            'preco'       => 'nullable|numeric|min:0',
            'preco_label' => 'nullable|string|max:50',
            'ativo'       => 'boolean',
            'ordem'       => 'integer|min:0',
        ]);

        $servico = $vitrine->servicos()->create($data);

        return response()->json($servico, 201);
    }

    public function update(Request $request, int $id)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $servico = $vitrine->servicos()->findOrFail($id);

        $data = $request->validate([
            'nome'        => 'sometimes|string|max:255',
            'descricao'   => 'nullable|string|max:1000',
            'preco'       => 'nullable|numeric|min:0',
            'preco_label' => 'nullable|string|max:50',
            'ativo'       => 'boolean',
            'ordem'       => 'integer|min:0',
        ]);

        $servico->update($data);

        return response()->json($servico);
    }

    public function destroy(Request $request, int $id)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $vitrine->servicos()->findOrFail($id)->delete();

        return response()->json(['message' => 'Serviço removido.']);
    }
}
