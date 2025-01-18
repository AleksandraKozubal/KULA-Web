<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestionResource\Pages;
use App\Models\Suggestion;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuggestionResource extends Resource
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
                    TextInput::make("description")
                        ->label("Opis")
                        ->required()
                        ->maxLength(255),
                    Select::make("status")
                        ->label("Status")
                        ->options(SuggestionStatus::class)
                        ->required(),
                    Select::make("user_id")
                        ->label("Użytkownik")
                        ->required(),
                    Select::make("kebab_place_id")
                        ->label("Miejsce kebaba")
                        ->required(),
                    TextInput::make("comment")
                        ->label("Komentarz")
                        ->maxLength(255),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Nazwa")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("status")
                    ->label("Status")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("user_id")
                    ->label("Użytkownik")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("kebab_place_id")
                    ->label("Miejsce kebaba")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("comment")
                    ->label("Komentarz")
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
            "index" => Pages\ListSuggestion::route("/"),
            "edit" => Pages\EditSuggestion::route("/{record}/edit"),
        ];
    }

    protected static ?string $model = Suggestion::class;
    protected static ?string $label = "sugestia";
    protected static ?string $pluralLabel = "Sugestie";
    protected static ?string $navigationIcon = "heroicon-o-bell-alert";
}
