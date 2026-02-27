<?php

namespace App\Filament\Painel\Resources\ServicoResource\Pages;

use App\Filament\Painel\Resources\ServicoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServico extends EditRecord
{
    protected static string $resource = ServicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
