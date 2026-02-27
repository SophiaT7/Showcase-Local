<?php

namespace App\Filament\Painel\Resources\VitrineResource\Pages;

use App\Filament\Painel\Resources\VitrineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVitrine extends EditRecord
{
    protected static string $resource = VitrineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
