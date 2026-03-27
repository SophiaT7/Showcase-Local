<?php

namespace App\Filament\Painel\Resources\HorarioResource\Pages;

use App\Filament\Painel\Resources\HorarioResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHorario extends CreateRecord
{
    protected static string $resource = HorarioResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vitrine_id'] = auth()->user()->vitrine?->id;

        return $data;
    }
}
