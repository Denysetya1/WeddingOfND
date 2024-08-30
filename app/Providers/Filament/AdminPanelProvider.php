<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
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
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\AkadResource;
use App\Filament\Resources\FotoawalResource;
use App\Filament\Resources\FotocoverResource;
use App\Filament\Resources\FotologoResource;
use App\Filament\Resources\FotonamacoverResource;
use App\Filament\Resources\FotopengantinpriaResource;
use App\Filament\Resources\FotopengantinResource;
use App\Filament\Resources\FotopengantinwanitaResource;
use App\Filament\Resources\FotorsvpResource;
use App\Filament\Resources\GalleryResource;
use App\Filament\Resources\PesanResource;
use App\Filament\Resources\ResepsiResource;
use App\Filament\Resources\RsvpResource;
use App\Filament\Resources\RsvpResource\Widgets\RsvpStatsWidget;
use App\Filament\Resources\UndanganResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\WeddinggiftResource;
use App\Filament\Resources\ZonawaktuResource;
use App\Http\Middleware\VerifyIsAdmin;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop(true)
            ->id('admin')
            ->path('admin')
            ->favicon(asset('storage/images/favicon-32x32.png'))
            ->colors([
                'primary'   => Color::hex('#ff66c2'),
                'warning'   => Color::Amber,
                'new'       => Color::Teal,
                'danger'    => Color::Red,
                'generate'  => Color::Purple,
                'link' => Color::hex('#dbff94'),
                'sky' => Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                RsvpStatsWidget::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make()
                        ->items([
                            NavigationItem::make('Dashboard')
                                ->icon('heroicon-o-home')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
                                ->url(fn (): string => Dashboard::getUrl()),
                            ...UndanganResource::getNavigationItems(),
                            ...RsvpResource::getNavigationItems(),
                            ...PesanResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Detail Acara')
                        ->items([

                            ...AkadResource::getNavigationItems(),
                            ...ResepsiResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Pengaturan Undangan')
                        ->items([
                            ...FotopengantinResource::getNavigationItems(),
                            ...WeddinggiftResource::getNavigationItems(),
                            ...ZonawaktuResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Pengaturan Foto')
                        ->items([
                            ...FotocoverResource::getNavigationItems(),
                            ...FotoawalResource::getNavigationItems(),
                            ...FotologoResource::getNavigationItems(),
                            ...FotonamacoverResource::getNavigationItems(),
                            ...GalleryResource::getNavigationItems(),
                            // ...FotopengantinpriaResource::getNavigationItems(),
                            // ...FotopengantinwanitaResource::getNavigationItems(),
                            // ...FotorsvpResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Pengaturan Akun Role')
                        ->items([
                            ...UserResource::getNavigationItems(),
                            NavigationItem::make('Role')
                                ->icon('heroicon-o-user-group')
                                ->isActiveWhen(fn (): bool => request()->routeIs([
                                    'filament.admin.resources.roles.index',
                                    'filament.admin.resources.roles.create',
                                    'filament.admin.resources.roles.view',
                                    'filament.admin.resources.roles.edit',
                                ]))
                                ->url(fn (): string => 'roles'),
                            NavigationItem::make('Permission')
                                ->icon('heroicon-o-lock-closed')
                                ->isActiveWhen(fn (): bool => request()->routeIs([
                                    'filament.admin.resources.permissions.index',
                                    'filament.admin.resources.permissions.create',
                                    'filament.admin.resources.permissions.view',
                                    'filament.admin.resources.permissions.edit',
                                ]))
                                ->url(fn (): string => 'permissions'),
                        ]),
                ]);
            })
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
                VerifyIsAdmin::class,
            ])
            // ->authMiddleware([
            //     Authenticate::class,
            // ])
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make());
    }
}
