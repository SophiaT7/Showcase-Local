<?php

namespace App\Filament\Painel\Pages;

use Filament\Pages\Auth\PasswordReset\ResetPassword;
use Filament\Http\Responses\Auth\Contracts\PasswordResetResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomResetPassword extends ResetPassword
{
    public function resetPassword(): ?PasswordResetResponse
    {
        $data = $this->form->getState();

        $user = User::where('email', $this->email)->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Notification::make()
                ->title('A nova senha não pode ser igual à senha atual.')
                ->danger()
                ->send();

            return null;
        }

        return parent::resetPassword();
    }
}
