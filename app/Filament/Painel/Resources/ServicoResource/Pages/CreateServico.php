<?php

namespace App\Filament\Painel\Resources\ServicoResource\Pages;

use App\Filament\Painel\Resources\ServicoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServico extends CreateRecord
{
    protected static string $resource = ServicoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vitrine_id'] = auth()->user()->vitrine?->id;

        return $data;
    }
}
