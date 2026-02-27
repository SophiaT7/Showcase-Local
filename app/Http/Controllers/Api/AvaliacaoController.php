<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vitrine;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $request->validate([
            'nome_visitante' => 'required|string|max:100',
            'nota'           => 'required|integer|min:1|max:5',
            'comentario'     => 'nullable|string|max:500',
        ]);

        $vitrine = Vitrine::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $avaliacao = $vitrine->avaliacoes()->create([
            'nome_visitante' => $request->nome_visitante,
            'nota'           => $request->nota,
            'comentario'     => $request->comentario,
            'aprovado'       => false,
        ]);

        return response()->json(['message' => 'Avaliação enviada com sucesso!'], 201);
    }
}
