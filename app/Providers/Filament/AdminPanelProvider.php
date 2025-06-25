<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->homeUrl('/admin')
            ->colors([
                'primary' => Color::Amber,
                'secondary' => Color::Gray,
                'success' => Color::Green,
                'danger' => Color::Red,
                'warning' => Color::Yellow,
                'info' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
                FilamentAuthenticate::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                $user = Auth::user();

                if (!$user) return $builder;

                $groups = [];

                // Menu dashboard umum
                $groups[] = NavigationGroup::make()->items([
                    NavigationItem::make('Dashboard')
                        ->icon('heroicon-o-home')
                        ->url(route('filament.admin.pages.dashboard'))
                        ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.dashboard')),
                ]);

                if ($user->role === 'admin') {
                    $groups[] = NavigationGroup::make('Manajemen Produk')->items([
                        NavigationItem::make('Produk')
                            ->icon('heroicon-o-cube')
                            ->url(route('filament.admin.resources.produks.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.produks.*')),

                        NavigationItem::make('Jenis Produk')
                            ->icon('heroicon-o-tag')
                            ->url(route('filament.admin.resources.jenis-produks.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.jenis-produks.*')),

                        NavigationItem::make('Kategori Tokoh')
                            ->icon('heroicon-o-tag')
                            ->url(route('filament.admin.resources.kategori-tokohs.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.kategori-tokohs.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Feedback')->items([
                        NavigationItem::make('Testimoni')
                            ->icon('heroicon-o-chat-bubble-left-ellipsis')
                            ->url(route('filament.admin.resources.testimonis.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.testimonis.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Manajemen Pengguna')->items([
                        NavigationItem::make('User')
                            ->icon('heroicon-o-users')
                            ->url(route('filament.admin.resources.users.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.users.*')),
                    ]);
                }

                if ($user->role === 'manager') {
                    $groups[] = NavigationGroup::make('Data Produk')->items([
                        NavigationItem::make('Produk')
                            ->icon('heroicon-o-cube')
                            ->url(route('filament.admin.resources.jenis-produks.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.jenisproduks.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Feedback')->items([
                        NavigationItem::make('Testimoni')
                            ->icon('heroicon-o-chat-bubble-left-ellipsis')
                            ->url(route('filament.admin.resources.testimonis.index'))
                            ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.testimonis.*')),
                    ]);
                }

                return $builder->groups($groups);
            });
    }
}
