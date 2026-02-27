<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vitrine;
use Illuminate\Http\Request;

class VitrineController extends Controller
{
        public function index(Request $request)
    {
        $query = Vitrine::with(['categoria'])
            ->where('status', 'active');

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('nome', 'like', "%{$request->q}%")
                  ->orWhere('descricao', 'like', "%{$request->q}%")
                  ->orWhereHas('categoria', fn($q) => $q->where('nome', 'like', "%{$request->q}%"))
                  ->orWhereHas('servicos', fn($q) => $q->where('nome', 'like', "%{$request->q}%"));
            });
        }

        if ($request->cidade) {
            $query->where('cidade', 'like', "%{$request->cidade}%");
        }

        if ($request->categoria) {
            $query->whereHas('categoria', fn($q) => $q->where('slug', $request->categoria));
        }

        return response()->json($query->paginate(12));
    }

    public function show(string $slug)
    {
        $vitrine = Vitrine::with([
            'categoria',
            'servicos' => fn($q) => $q->where('ativo', true)->orderBy('ordem'),
            'galeria',
            'horarios',
            'avaliacoes' => fn($q) => $q->where('aprovado', true)->latest()->take(10),
        ])
        ->where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

        $vitrine->media_avaliacoes = $vitrine->avaliacoes->avg('nota') ?? 0;
        $vitrine->total_avaliacoes = $vitrine->avaliacoes->count();

        return response()->json($vitrine);
    }
}
