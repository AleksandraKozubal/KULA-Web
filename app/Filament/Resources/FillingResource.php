<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FillingResource\Pages;
use App\Models\Filling;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FillingResource extends Resource
{
    protected static ?string $model = Filling::class;
    protected static ?string $label = "mięso";
    protected static ?string $pluralLabel = "Mięsa";
    protected static ?string $navigationIcon = "heroicon-o-circle-stack";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make("name")
                        ->label("Nazwa")
                        ->required()
                        ->maxLength(255),
                    ColorPicker::make("hex_color")
                        ->label("Kolor")
                        ->required(),
                    Checkbox::make("is_vegan")
                        ->label("Czy wegański?")
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Mięso")
                    ->sortable()
                    ->searchable(),
                IconColumn::make("is_vegan")
                    ->label("Wegańskie")
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
            "index" => Pages\ListFillings::route("/"),
            "create" => Pages\CreateFilling::route("/create"),
            "edit" => Pages\EditFilling::route("/{record}/edit"),
        ];
    }
}
