<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SauceResource\Pages;
use App\Models\Sauce;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SauceResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make("name")
                        ->label("Nazwa")
                        ->required()
                        ->maxLength(255),
                    Select::make("spiciness")
                        ->label("Ostrość")
                        ->options([
                            1 => "Bardzo łagodny",
                            2 => "Łagodny",
                            3 => "Średni",
                            4 => "Ostry",
                            5 => "Bardzo ostry",
                        ])
                        ->required(),
                    Checkbox::make("is_vegan")
                        ->label("Wegański"),
                    Checkbox::make("is_gluten_free")
                        ->label("Bezglutenowy"),
                    ColorPicker::make("hex_color")
                        ->label("Kolor"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Sos")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("spiciness")
                    ->label("Ostrość")
                    ->sortable(),
                IconColumn::make("is_vegan")
                    ->label("Wegański")
                    ->boolean()
                    ->sortable(),
                IconColumn::make("is_gluten_free")
                    ->label("Bezglutenowy")
                    ->boolean()
                    ->sortable(),
                ColorColumn::make("hex_color")
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

    protected static ?string $model = Sauce::class;
    protected static ?string $label = "sos";
    protected static ?string $pluralLabel = "Sosy";
    protected static ?string $navigationIcon = "heroicon-o-beaker";
}
