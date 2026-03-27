<?php

namespace App\Filament\Painel\Resources\VitrineResource\Pages;

use App\Filament\Painel\Resources\VitrineResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateVitrine extends CreateRecord
{
    protected static string $resource = VitrineResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['nome']) . '-' . Str::random(5);
        $data['status'] = 'active';

        return $data;
    }
}
