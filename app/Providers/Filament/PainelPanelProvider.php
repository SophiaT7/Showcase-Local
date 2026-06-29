<?php

namespace App\Providers\Filament;

use App\Filament\Painel\Pages\CustomResetPassword;
use App\Filament\Painel\Pages\EditProfile;
use App\Filament\Painel\Pages\PainelRegistration;
use App\Filament\Painel\Pages\UnifiedLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PainelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('painel')
            ->path('painel')
            ->login(UnifiedLogin::class)
            ->passwordReset(resetAction: CustomResetPassword::class)
            ->registration(PainelRegistration::class)
            ->profile(EditProfile::class)
            ->brandName('Vitrine Local')
            ->brandLogo(asset('logoVitrine.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('logoVitrine.png'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Painel/Resources'), for: 'App\\Filament\\Painel\\Resources')
            ->discoverPages(in: app_path('Filament/Painel/Pages'), for: 'App\\Filament\\Painel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Painel/Widgets'), for: 'App\\Filament\\Painel\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                \App\Http\Middleware\LogoutOnPanelSwitch::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
