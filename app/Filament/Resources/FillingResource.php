<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FillingResource\Pages;
use App\Models\Sauce;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FillingResource extends Resource
{
    protected static ?string $model = Sauce::class;
    protected static ?string $label = "mięso";
    protected static ?string $pluralLabel = "Mięsa";
    protected static ?string $navigationIcon = "heroicon-o-circle-stack";

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
                    ->label("Mięso")
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
            "index" => Pages\ListFillings::route("/"),
            "create" => Pages\CreateFilling::route("/create"),
            "edit" => Pages\EditFilling::route("/{record}/edit"),
        ];
    }
}