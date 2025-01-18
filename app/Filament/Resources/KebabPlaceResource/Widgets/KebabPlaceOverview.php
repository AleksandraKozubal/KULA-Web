<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabPlaceResource\Widgets;

use App\Models\KebabPlace;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class KebabPlaceOverview extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                KebabPlace::query(),
            )
            ->columns([
                Tables\Columns\ImageColumn::make("image")->square(),
                Tables\Columns\TextColumn::make("name"),
                Tables\Columns\TextColumn::make("status")->badge()
                    ->color(fn(KebabPlace $kebabPlace) => match ($kebabPlace->status) {
                        "otwarte" => "success",
                        "planowane" => "info",
                        "zamknięte" => "danger",
                        default => "warning",
                    }),
            ])
            ->defaultPaginationPageOption(5);
    }
}
