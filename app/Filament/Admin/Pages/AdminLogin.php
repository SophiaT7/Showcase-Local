<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Auth\Login;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Illuminate\Validation\ValidationException;

class AdminLogin extends Login
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();
            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if ($user->role === 'empreendedor') {
            session()->regenerate();
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    return redirect('/painel');
                }
            };
        }

        if (! $user->canAccessPanel(Filament::getCurrentPanel())) {
            Filament::auth()->logout();
            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
