<?php

namespace App\Filament\Painel\Resources\GaleriaFotoResource\Pages;

use App\Filament\Painel\Resources\GaleriaFotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleriaFotos extends ListRecords
{
    protected static string $resource = GaleriaFotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
