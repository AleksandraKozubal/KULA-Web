<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestionResource\Pages;
use App\Models\KebabPlace;
use App\Models\Suggestion;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SuggestionResource extends Resource
{
    protected static ?string $model = Suggestion::class;
    protected static ?string $label = "sugestię";
    protected static ?string $pluralLabel = "Sugestie";
    protected static ?string $navigationIcon = "heroicon-o-bell-alert";
    protected static bool $hasTitleCaseModelLabel = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make(2)->schema([
                        Select::make("user_id")
                            ->label("Osoba zgłaszająca")
                            ->options(
                                User::all()
                                    ->pluck("name", "id")
                                    ->toArray(),
                            )
                            ->disabled()
                            ->required(),
                        Select::make("kebab_place_id")
                            ->label("Kebab, którego dotyczy sugestia")
                            ->options(
                                KebabPlace::all()
                                    ->pluck("name", "id")
                                    ->toArray(),
                            )
                            ->disabled()
                            ->required(),
                    ]),
                    TextInput::make("name")
                        ->label("Temat")
                        ->required()
                        ->disabled()
                        ->maxLength(255),
                    Textarea::make("description")
                        ->label("Szczegóły")
                        ->required()
                        ->disabled()
                        ->maxLength(255),
                    Select::make("status")
                        ->label("Status")
                        ->options(SuggestionStatus::class)
                        ->required(),
                    Textarea::make("comment")
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
                    ->description(fn(Suggestion $suggestion): string => Str::limit($suggestion->description ?? "", 25)) // Limit opisu do 50 znaków                    ->limit(25)
                    ->sortable()
                    ->wrap()
                    ->searchable(),
                TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->color(fn(Suggestion $suggestion): string => match ($suggestion->status) {
                        SuggestionStatus::Accepted => "success",
                        SuggestionStatus::Rejected => "danger",
                        default => "warning",
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SelectColumn::make("user_id")
                    ->label("Użytkownik")
                    ->options(
                        User::all()
                            ->pluck("name", "id")
                            ->toArray(),
                    )
                    ->disabled()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SelectColumn::make("kebab_place_id")
                    ->label("Kebab")
                    ->options(
                        KebabPlace::all()
                            ->pluck("name", "id")
                            ->toArray(),
                    )
                    ->disabled()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make("status")
                    ->label("Status")
                    ->options(SuggestionStatus::class),
                SelectFilter::make("user_id")
                    ->label("Użytkownik")
                    ->options(
                        User::all()
                            ->pluck("name", "id")
                            ->toArray(),
                    ),
                SelectFilter::make("kebab_place_id")
                    ->label("Kebab")
                    ->options(
                        KebabPlace::all()
                            ->pluck("name", "id")
                            ->toArray(),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canUpdate(Model $record): bool
    {
        return $record->status === SuggestionStatus::Pending;
    }

    public static function canEdit(Model $record): bool
    {
        return $record->status === SuggestionStatus::Pending;
    }

    public static function canDelete(Model $record): bool
    {
        return $record->status === SuggestionStatus::Pending;
    }
}
