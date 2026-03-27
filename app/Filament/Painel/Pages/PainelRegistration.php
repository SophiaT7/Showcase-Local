<?php

namespace App\Filament\Painel\Pages;

use Filament\Pages\Auth\Register;

class PainelRegistration extends Register
{
    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['role'] = 'empreendedor';

        return $data;
    }
}
