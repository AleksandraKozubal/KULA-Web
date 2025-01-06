<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SauceResource\Pages;
use App\Models\Sauce;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SauceResource extends Resource
{
    protected static ?string $model = Sauce::class;
    protected static ?string $label = "sos";
    protected static ?string $pluralLabel = "Sosy";
    protected static ?string $navigationIcon = "heroicon-o-beaker";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\TextInput::make("name")
                        ->label("Nazwa")
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make("spiciness")
                        ->label("Ostrość")
                        ->options([
                            1 => "Bardzo łagodny",
                            2 => "Łagodny",
                            3 => "Średni",
                            4 => "Ostry",
                            5 => "Bardzo ostry",
                        ])
                        ->required(),
                    Forms\Components\Checkbox::make("is_vegan")
                        ->label("Wegański"),
                    Forms\Components\Checkbox::make("is_gluten_free")
                        ->label("Bezglutenowy"),
                    Forms\Components\ColorPicker::make("hex_color")
                        ->label("Kolor"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label("Sos")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make("spiciness")
                    ->label("Ostrość")
                    ->sortable(),
                Tables\Columns\BooleanColumn::make("is_vegan")
                    ->label("Wegański")
                    ->sortable(),
                Tables\Columns\BooleanColumn::make("is_gluten_free")
                    ->label("Bezglutenowy")
                    ->sortable(),
                Tables\Columns\ColorColumn::make("hex_color")
                    ->label("Kolor")
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListSauces::route("/"),
            "create" => Pages\CreateSauce::route("/create"),
            "edit" => Pages\EditSauce::route("/{record}/edit"),
        ];
    }
}
