<?php

namespace App\Filament\Painel\Resources\VitrineResource\Pages;

use App\Filament\Painel\Resources\VitrineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVitrines extends ListRecords
{
    protected static string $resource = VitrineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
