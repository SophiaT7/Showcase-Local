<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaFotoController extends Controller
{
    public function index(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        return response()->json($vitrine->galeria()->orderBy('ordem')->get());
    }

    public function store(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $request->validate([
            'foto'    => 'required|image|max:4096',
            'legenda' => 'nullable|string|max:255',
            'ordem'   => 'integer|min:0',
        ]);

        $path = $request->file('foto')->store('vitrines/galeria', 'public');

        $foto = $vitrine->galeria()->create([
            'path'    => $path,
            'legenda' => $request->legenda,
            'ordem'   => $request->ordem ?? 0,
        ]);

        return response()->json($foto, 201);
    }

    public function update(Request $request, int $id)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $foto = $vitrine->galeria()->findOrFail($id);

        $data = $request->validate([
            'legenda' => 'nullable|string|max:255',
            'ordem'   => 'integer|min:0',
        ]);

        $foto->update($data);

        return response()->json($foto);
    }

    public function destroy(Request $request, int $id)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $foto = $vitrine->galeria()->findOrFail($id);

        Storage::disk('public')->delete($foto->path);
        $foto->delete();

        return response()->json(['message' => 'Foto removida.']);
    }
}
