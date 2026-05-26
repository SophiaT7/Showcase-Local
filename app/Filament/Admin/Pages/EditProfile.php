<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('profile_photo')
                    ->label('Foto de Perfil')
                    ->image()
                    ->avatar()
                    ->directory('profile-photos')
                    ->disk('public')
                    ->maxSize(2048)
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('400')
                    ->imageResizeTargetHeight('400')
                    ->helperText('Recomendado: 400x400 pixels'),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
            ]);
    }
}
