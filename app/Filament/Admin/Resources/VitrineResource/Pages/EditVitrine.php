<?php

namespace App\Filament\Admin\Resources\VitrineResource\Pages;

use App\Filament\Admin\Resources\VitrineResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

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
