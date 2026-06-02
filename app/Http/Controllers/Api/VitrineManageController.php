<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vitrine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VitrineManageController extends Controller
{
    public function show(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Você ainda não possui uma vitrine.'], 404);
        }

        return response()->json(
            $vitrine->load(['categoria', 'servicos', 'galeria', 'horarios', 'avaliacoes'])
        );
    }

    public function store(Request $request)
    {
        if ($request->user()->vitrine) {
            return response()->json(['message' => 'Você já possui uma vitrine.'], 409);
        }

        $data = $request->validate([
            'nome'         => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao'    => 'nullable|string|max:2000',
            'whatsapp'     => 'nullable|string|max:20',
            'instagram'    => 'nullable|string|max:255',
            'cidade'       => 'required|string|max:100',
            'bairro'       => 'nullable|string|max:100',
            'estado'       => 'required|string|max:2',
            'cor_primaria' => 'nullable|string|max:7',
            'foto_perfil'  => 'nullable|image|max:2048',
            'banner'       => 'nullable|image|max:4096',
        ]);

        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['nome']) . '-' . Str::random(5);
        $data['status'] = 'active';

        if ($request->hasFile('foto_perfil')) {
            $data['foto_perfil'] = $request->file('foto_perfil')->store('vitrines/perfil', 'public');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('vitrines/banner', 'public');
        }

        $vitrine = Vitrine::create($data);

        return response()->json($vitrine->load('categoria'), 201);
    }

    public function update(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $data = $request->validate([
            'nome'         => 'sometimes|string|max:255',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'descricao'    => 'nullable|string|max:2000',
            'whatsapp'     => 'nullable|string|max:20',
            'instagram'    => 'nullable|string|max:255',
            'cidade'       => 'sometimes|string|max:100',
            'bairro'       => 'nullable|string|max:100',
            'estado'       => 'sometimes|string|max:2',
            'cor_primaria' => 'nullable|string|max:7',
            'foto_perfil'  => 'nullable|image|max:2048',
            'banner'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto_perfil')) {
            if ($vitrine->foto_perfil) {
                Storage::disk('public')->delete($vitrine->foto_perfil);
            }
            $data['foto_perfil'] = $request->file('foto_perfil')->store('vitrines/perfil', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($vitrine->banner) {
                Storage::disk('public')->delete($vitrine->banner);
            }
            $data['banner'] = $request->file('banner')->store('vitrines/banner', 'public');
        }

        if (isset($data['nome'])) {
            $data['slug'] = Str::slug($data['nome']) . '-' . Str::random(5);
        }

        $vitrine->update($data);

        return response()->json($vitrine->fresh()->load('categoria'));
    }

    public function avaliacoes(Request $request)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        return response()->json(
            $vitrine->avaliacoes()->latest()->paginate(15)
        );
    }

    public function aprovarAvaliacao(Request $request, int $avaliacaoId)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $avaliacao = $vitrine->avaliacoes()->findOrFail($avaliacaoId);
        $avaliacao->update(['aprovado' => true]);

        return response()->json(['message' => 'Avaliação aprovada.']);
    }

    public function rejeitarAvaliacao(Request $request, int $avaliacaoId)
    {
        $vitrine = $request->user()->vitrine;

        if (! $vitrine) {
            return response()->json(['message' => 'Vitrine não encontrada.'], 404);
        }

        $avaliacao = $vitrine->avaliacoes()->findOrFail($avaliacaoId);
        $avaliacao->delete();

        return response()->json(['message' => 'Avaliação rejeitada.']);
    }
}
