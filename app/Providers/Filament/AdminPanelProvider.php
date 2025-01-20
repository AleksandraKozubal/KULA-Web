<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Resources\KebabPlaceResource\Widgets\KebabPlaceOverview;
use App\Filament\Resources\KebabPlaceResource\Widgets\KebabPlaceStats;
use App\Http\Middleware\CheckIfInitialized;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\View\View;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id("admin")
            ->path("")
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->colors([
                "primary" => Color::Pink,
            ])
            ->brandLogo(fn(): View => view("filament.logo"))
            ->favicon(asset("identification/sygnet.svg"))
            ->discoverResources(in: app_path("Filament/Resources"), for: "App\\Filament\\Resources")
            ->discoverPages(in: app_path("Filament/Pages"), for: "App\\Filament\\Pages")
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path("Filament/Widgets"), for: "App\\Filament\\Widgets")
            ->widgets([
                KebabPlaceStats::class,
                KebabPlaceOverview::class,
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
                CheckIfInitialized::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa();
    }
}
