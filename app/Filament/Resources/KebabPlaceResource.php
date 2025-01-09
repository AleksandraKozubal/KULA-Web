<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\KebabPlaceLocationType;
use App\Enums\KebabPlaceStatus;
use App\Filament\Resources\KebabResource\Pages\CreateKebabPlace;
use App\Filament\Resources\KebabResource\Pages\EditKebabPlace;
use App\Filament\Resources\KebabResource\Pages\ListKebabPlace;
use App\Models\Filling;
use App\Models\KebabPlace;
use App\Models\Sauce;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class KebabPlaceResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make("name")
                            ->label("Nazwa")
                            ->required()
                            ->maxLength(255),
                        Grid::make(2)->schema([
                            Checkbox::make("is_craft")
                                ->label("Mięso kraftowe"),
                            Checkbox::make("is_chain_restaurant")
                                ->label("Sieciówka"),
                        ]),
                        FileUpload::make("image")
                            ->label("Zdjęcie")
                            ->directory(KebabPlace::PHOTOS_DIRECTORY)
                            ->multiple(false),
                        TextInput::make("street")
                            ->label("Ulica")
                            ->required()
                            ->maxLength(255),
                        TextInput::make("building_number")
                            ->label("Numer budynku")
                            ->required()
                            ->maxLength(255),
                        Grid::make(2)->schema([
                            TextInput::make("latitude")
                                ->label("Szerokość geograficzna")
                                ->numeric()
                                ->required(),
                            TextInput::make("longitude")
                                ->label("Długość geograficzna")
                                ->numeric()
                                ->required(),
                            TextInput::make("google_maps_url")
                                ->label("Google Maps URL")
                                ->maxLength(255),
                            TextInput::make("google_maps_rating")
                                ->label("Google Maps Ocena")
                                ->numeric()
                                ->step(0.1)
                                ->minValue(0)
                                ->maxValue(5),
                        ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make("opened_at_year")
                                    ->numeric()
                                    ->minValue(1950)
                                    ->maxValue(date("Y"))
                                    ->label("Rok otwarcia"),
                                TextInput::make("closed_at_year")
                                    ->numeric()
                                    ->minValue(1950)
                                    ->maxValue(date("Y"))
                                    ->label("Rok zamknięcia"),
                            ]),
                        Grid::make(2)->schema([
                            Select::make("sauces")
                                ->label("Sosy")
                                ->multiple()
                                ->options(Sauce::all()->pluck("name", "id")->toArray()),
                            Select::make("fillings")
                                ->label("Mięsa")
                                ->multiple()
                                ->options(Filling::all()->pluck("name", "id")->toArray()),
                        ]),
                        Section::make([
                            Repeater::make("social_media")
                                ->label("Media społecznościowe")
                                ->schema([
                                    Select::make("Name")
                                        ->label("Nazwa")
                                        ->options([
                                            "fb" => "Facebook",
                                            "ig" => "Instagram",
                                            "tt" => "Tiktok",
                                            "x" => "X",
                                        ]),
                                    TextInput::make("url")
                                        ->label("url")
                                        ->nullable(),
                                ])
                                ->addable()
                                ->deletable()
                                ->reorderable(false)
                                ->columns(2),
                            Grid::make(2)->schema([
                                TextInput::make("phone")
                                    ->label("Telefon")
                                    ->maxLength(255),
                                TextInput::make("email")
                                    ->label("Email")
                                    ->maxLength(255),
                            ]),
                            TextInput::make("website")
                                ->label("Strona internetowa")
                                ->maxLength(255),
                        ]),
                    ]),
                    Section::make([
                        Grid::make(3)->schema([
                            Select::make("status")
                                ->label("Status")
                                ->required()
                                ->options(array_column(KebabPlaceStatus::cases(), "value")),
                            Select::make("location_type")
                                ->label("Typ lokalizacji")
                                ->required()
                                ->options(array_column(KebabPlaceLocationType::cases(), "value")),
                            Select::make("order_options")
                                ->label("Opcje zamówienia")
                                ->required()
                                ->multiple()
                                ->options([
                                    "phone" => "przez telefon",
                                    "glovo" => "glovo",
                                    "pyszne" => "pyszne.pl",
                                    "uber_eats" => "Uber Eats",
                                    "app" => "własna aplikacja",
                                    "web" => "własna strona",
                                ]),
                        ]),
                        Repeater::make("opening_hours")
                            ->label("Godziny otwarcia")
                            ->schema([
                                TextInput::make("day")
                                    ->label("Dzień")
                                    ->disabled()
                                    ->default(fn($state, $record, $index) => [
                                        "Poniedziałek", "Wtorek", "Środa",
                                        "Czwartek", "Piątek", "Sobota", "Niedziela",
                                    ][$index]),
                                TimePicker::make("from")
                                    ->label("Od")
                                    ->format("H:i")
                                    ->timezone("Europe/Warsaw")
                                    ->seconds(false)
                                    ->nullable(),
                                TimePicker::make("to")
                                    ->label("Do")
                                    ->format("H:i")
                                    ->timezone("Europe/Warsaw")
                                    ->seconds(false)
                                    ->nullable(),
                            ])
                            ->default(fn() => collect([
                                ["day" => "Poniedziałek", "from" => null, "to" => null],
                                ["day" => "Wtorek", "from" => null, "to" => null],
                                ["day" => "Środa", "from" => null, "to" => null],
                                ["day" => "Czwartek", "from" => null, "to" => null],
                                ["day" => "Piątek", "from" => null, "to" => null],
                                ["day" => "Sobota", "from" => null, "to" => null],
                                ["day" => "Niedziela", "from" => null, "to" => null],
                            ])->toArray())
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->columns(3),
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
                TextColumn::make("name")
                    ->label("Nazwa")
                    ->searchable(),
                TextColumn::make("status")
                    ->label("Status")
                    ->searchable(),
                TextColumn::make("location_type")
                    ->label("Typ lokalizacji")
                    ->searchable(),
                Tables\Columns\IconColumn::make("is_craft")
                    ->label("Mięso kraftowe")
                    ->boolean(),
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
            "index" => ListKebabPlace::route("/"),
            "create" => CreateKebabPlace::route("/create"),
            "edit" => EditKebabPlace::route("/{record}/edit"),
        ];
    }

    protected static ?string $model = KebabPlace::class;
    protected static ?string $label = "kebab";
    protected static ?string $pluralLabel = "Kebaby";
    protected static ?string $navigationIcon = "heroicon-o-building-storefront";
    protected static bool $hasTitleCaseModelLabel = false;
}
