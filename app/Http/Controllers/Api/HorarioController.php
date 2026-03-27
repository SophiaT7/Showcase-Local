<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        return response()->json($vitrine->horarios()->orderBy('dia_semana')->get());
    }

    public function upsert(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $request->validate([
            'horarios'              => 'required|array|min:1|max:7',
            'horarios.*.dia_semana' => 'required|integer|min:0|max:6',
            'horarios.*.abertura'   => 'nullable|date_format:H:i',
            'horarios.*.fechamento' => 'nullable|date_format:H:i',
            'horarios.*.fechado'    => 'boolean',
        ]);

        foreach ($request->horarios as $h) {
            $vitrine->horarios()->updateOrCreate(
                ['dia_semana' => $h['dia_semana']],
                [
                    'abertura'   => $h['abertura'] ?? null,
                    'fechamento' => $h['fechamento'] ?? null,
                    'fechado'    => $h['fechado'] ?? false,
                ]
            );
        }

        return response()->json($vitrine->horarios()->orderBy('dia_semana')->get());
    }
}
