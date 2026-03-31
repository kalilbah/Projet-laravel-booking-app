<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages\CreateProperty;
use App\Filament\Resources\PropertyResource\Pages\EditProperty;
use App\Filament\Resources\PropertyResource\Pages\ListProperties;
use App\Models\Property;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string | UnitEnum | null $navigationGroup = 'Catalogue';

    protected static ?string $navigationLabel = 'Propriétés';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'propriété';

    protected static ?string $pluralModelLabel = 'propriétés';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations du bien')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('price_per_night')
                            ->label('Prix par nuit')
                            ->required()
                            ->numeric()
                            ->prefix('EUR')
                            ->step('0.01'),
                        Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price_per_night')
                    ->label('Prix / nuit')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('bookings_count')
                    ->label('Réservations')
                    ->counts('bookings')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('created_at')
                    ->label('Creation')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::query()->count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'primary';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
