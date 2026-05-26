<?php

namespace App\Filament\Painel\Pages;

use Filament\Pages\Auth\Login;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;

class UnifiedLogin extends Login
{
    private const COOKIE_NAME = 'remember_painel';
    private const CACHE_PREFIX = 'remember_painel_';
    private const REMEMBER_DAYS = 30;

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
            return;
        }

        $saved = $this->loadSavedCredentials();

        $this->form->fill($saved);
    }

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

        $this->saveOrForgetCredentials($data);

        $user = Filament::auth()->user();

        if ($user->role === 'admin') {
            session()->regenerate();
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    return redirect('/admin');
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

    private function loadSavedCredentials(): array
    {
        $email = request()->cookie(self::COOKIE_NAME);

        if (! $email) {
            return [];
        }

        $cacheKey = self::CACHE_PREFIX . md5($email);
        $encrypted = Cache::get($cacheKey);

        if (! $encrypted) {
            return [];
        }

        try {
            $password = Crypt::decryptString($encrypted);
            return [
                'email' => $email,
                'password' => $password,
                'remember' => true,
            ];
        } catch (\Exception $e) {
            Cache::forget($cacheKey);
            return [];
        }
    }

    private function saveOrForgetCredentials(array $data): void
    {
        $email = $data['email'];
        $cacheKey = self::CACHE_PREFIX . md5($email);
        $expireMinutes = self::REMEMBER_DAYS * 24 * 60;

        if (! empty($data['remember'])) {
            Cache::put($cacheKey, Crypt::encryptString($data['password']), now()->addMinutes($expireMinutes));

            Cookie::queue(self::COOKIE_NAME, $email, $expireMinutes);
        } else {
            Cache::forget($cacheKey);

            Cookie::queue(Cookie::forget(self::COOKIE_NAME));
        }
    }
}
