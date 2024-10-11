<?php

declare(strict_types=1);

namespace App\Providers\Filament;

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
use Filament\Widgets;
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
                "primary" => Color::Sky,
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
            ])
            ->navigationGroups([
                NavigationGroup::make("linki projektowe")->collapsible(false),
            ])
            ->navigationItems([
                NavigationItem::make("OPZ")
                    ->url("https://drive.google.com/file/d/1rzBXt32Hwl9UaX9H00mx_Al4heIaSa4a/view?authuser=1&usp=classroom_web", shouldOpenInNewTab: true)
                    ->icon("heroicon-o-clipboard-document-list")
                    ->group("linki projektowe"),
                NavigationItem::make("PUM - zasady")
                    ->url("https://github.com/kamilpiech97/cwup-resources/blob/main/INF/2024-2025/s7/pum/classes/lab01.md", shouldOpenInNewTab: true)
                    ->icon("heroicon-o-device-phone-mobile")
                    ->group("linki projektowe"),
                NavigationItem::make("PZ - zasady")
                    ->url("https://github.com/krzysztofrewak/cwup/blob/main/projects/pz.md", shouldOpenInNewTab: true)
                    ->icon("heroicon-o-users")
                    ->group("linki projektowe"),
            ])
            ->spa();
    }
}
