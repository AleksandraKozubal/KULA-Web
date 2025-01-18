<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabPlaceResource\Widgets;

use App\Models\KebabPlace;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar;

class KebabPlaceOverview extends BaseWidget
{
    protected static ?string $heading = 'Kebaby';

    public function table(Table $table): Table
    {
        return $table
            ->query(KebabPlace::query())
            ->columns([
                ImageColumn::make("image")->square(),
                TextColumn::make("name"),
                RatingStar::make("google_maps_rating")
                    ->label("Ocena"),
//                TextColumn::make("status")->badge()
//                    ->color(fn(KebabPlace $kebabPlace): string => match ($kebabPlace->status) {
//                        "otwarte" => "success",
//                        "planowane" => "info",
//                        "zamknięte" => "danger",
//                        default => "warning",
//                    }),
            ])
            ->defaultPaginationPageOption(5);
    }
}
