<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\KebabResource\Pages\CreateKebab;
use App\Filament\Resources\KebabResource\Pages\EditKebab;
use App\Models\Kebab;
use Blumilk\Website\Filament\Resources\NewsResource\Pages\ListKebab;
use Filament\Resources\Resource;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class KebabResource extends Resource
{
    protected static ?string $model = Kebab::class;
    protected static ?string $label = "kebab";
    protected static ?string $pluralLabel = "Kebaby";
    protected static ?string $navigationIcon = "heroicon-o-cake";
    protected static bool $hasTitleCaseModelLabel = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Forms\Components\TextInput::make("name")
                            ->label("Nazwa")
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Forms\Components\Checkbox::make("is_craft")
                            ->label("Mięso kraftowe"),
                        Forms\Components\Checkbox::make("is_chain_restaurant")
                            ->label("Sieciówka"),
                        Forms\Components\FileUpload::make("logo")
                            ->label("Logo")
                            ->required()
                            ->directory(Kebab::PHOTOS_DIRECTORY)
                            ->multiple(false)
                            ->maxSize(2500),
                    ]),
                    Section::make([
                        Forms\Components\TextInput::make("address")
                            ->label("Adres")
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make("lat")
                            ->label("Szerokość geograficzna")
                            ->required()
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make("lng")
                            ->label("Długość geograficzna")
                            ->required()
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make('opened_at_year')
                            ->numeric()
                            ->minValue(1950)
                            ->maxValue(date('Y'))
                            ->label("Rok otwarcia"),
                        Forms\Components\TextInput::make('closed_at_year')
                            ->numeric()
                            ->minValue(1950)
                            ->maxValue(date('Y'))
                            ->label("Rok zamknięcia"),
                    ]),
                    Section::make([
                        Forms\Components\KeyValue::make('opening_hours')
                            ->label('Godziny otwarcia')
                            ->default(fn($state) => [
                                "Poniedziałek" => '',
                                "Wtorek" => '',
                                "Środa" => '',
                                "Czwartek" => '',
                                "Piątek" => '',
                                "Sobota" => '',
                                "Niedziela" => '',
                            ])
                            ->addable(false)
                            ->deletable(false)
                            ->editableKeys(false)
                            ->keyLabel('Dzień tygodnia')
                            ->valueLabel('Godziny'),
                        Forms\Components\Select::make("status")
                            ->label("Status")
                            ->required()
                            ->options([
                                "open" => "Otwarte",
                                "closed" => "Zamknięte",
                                "planned" => "Planowane",
                            ]),
                        Forms\Components\Select::make("location_type")
                            ->label("Typ lokalizacji")
                            ->required()
                            ->options([
//                                dine-in, food stand
                                "dine-in" => "Lokal",
                                "food stand" => "Buda",
                            ]),
                    ]),
                ])->from("lg"),
            ])->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label("Nazwa")
                    ->searchable(),
                Tables\Columns\TextColumn::make("status")
                    ->label("Status")
                    ->searchable(),
                Tables\Columns\TextColumn::make("location_type")
                    ->label("Typ lokalizacji")
                    ->searchable(),
                Tables\Columns\CheckboxColumn::make("is_craft")
                    ->label("Mięso kraftowe"),
            ])
            ->filters([
                TernaryFilter::make("is_craft")
                    ->label("Mięso")
                    ->placeholder("Wszystkie")
                    ->trueLabel("Kraftowe")
                    ->falseLabel("Kula"),
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
            "index" => ListKebab::route("/"),
            "create" => CreateKebab::route("/create"),
            "edit" => EditKebab::route("/{record}/edit"),
        ];
    }
}
