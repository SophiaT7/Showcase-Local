<?php

namespace App\Filament\Painel\Resources\GaleriaFotoResource\Pages;

use App\Filament\Painel\Resources\GaleriaFotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGaleriaFoto extends CreateRecord
{
    protected static string $resource = GaleriaFotoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vitrine_id'] = auth()->user()->vitrine?->id;

        return $data;
    }
}
