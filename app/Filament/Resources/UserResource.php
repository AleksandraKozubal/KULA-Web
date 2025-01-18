<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make("name")
                        ->label("Imię i nazwisko")
                        ->required()
                        ->maxLength(255),
                    TextInput::make("email")
                        ->label("E-mail")
                        ->required()
                        ->email()
                        ->unique(),
                    Select::make("role")
                        ->label("Rola")
                        ->options(Role::class)
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Imię i nazwisko")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("email")
                    ->label("E-mail")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("role")
                    ->label("Rola")
                    ->badge()
                    ->color(fn(User $user): string => match ($user->role) {
                        Role::Admin => "success",
                        Role::User => "primary",
                        default => "warning",
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make("role")
                    ->label("Rola")
                    ->options(Role::class),
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
            "index" => Pages\ListUser::route("/"),
            "edit" => Pages\EditUser::route("/{record}/edit"),
            "create" => Pages\CreateUser::route("/create"),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canUpdate(Model $record): bool
    {
        return $record->role !== Role::Admin;
    }

    public static function canEdit(Model $record): bool
    {
        return $record->role !== Role::Admin;
    }

    public static function canDelete(Model $record): bool
    {
        return $record->role !== Role::Admin;
    }

    protected static ?string $model = User::class;
    protected static ?string $label = "użytkownika";
    protected static ?string $pluralLabel = "Użytkownicy";
    protected static ?string $navigationIcon = "heroicon-o-users";
    protected static bool $hasTitleCaseModelLabel = false;
}
