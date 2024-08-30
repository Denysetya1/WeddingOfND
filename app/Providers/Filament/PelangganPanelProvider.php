<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Pages\Auth\Login;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PelangganPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('pelanggan')
            ->path('pelanggan')
            ->login(Login::class)
            ->registration()
            ->profile()
            ->favicon(asset('storage/images/favicon-32x32.png'))
            ->colors([
                'primary'   => Color::hex('#ff66c2'),
                'warning'   => Color::Amber,
                'new'       => Color::Teal,
                'danger'    => Color::Red,
                'generate'  => Color::Violet,
                'link' => Color::hex('#dbff94'),
            ])
            ->discoverResources(in: app_path('Filament/Pelanggan/Resources'), for: 'App\\Filament\\Pelanggan\\Resources')
            ->discoverPages(in: app_path('Filament/Pelanggan/Pages'), for: 'App\\Filament\\Pelanggan\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Pelanggan/Widgets'), for: 'App\\Filament\\Pelanggan\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
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
