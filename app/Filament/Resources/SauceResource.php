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
