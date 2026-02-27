<?php

namespace App\Filament\Admin\Resources\VitrineResource\Pages;

use App\Filament\Admin\Resources\VitrineResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;


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
