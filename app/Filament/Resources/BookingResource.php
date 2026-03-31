<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages\CreateBooking;
use App\Filament\Resources\BookingResource\Pages\EditBooking;
use App\Filament\Resources\BookingResource\Pages\ListBookings;
use App\Models\Booking;
use App\Models\User;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string | UnitEnum | null $navigationGroup = 'Réservations';

    protected static ?string $navigationLabel = 'Réservations';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'réservation';

    protected static ?string $pluralModelLabel = 'réservations';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Réservation')
                    ->schema([
                        Select::make('user_id')
                            ->label('Utilisateur')
                            ->relationship('user', 'email')
                            ->getOptionLabelFromRecordUsing(fn(User $record): string => $record->name . ' - ' . $record->email)
                            ->searchable(['name', 'email'])
                            ->preload()
                            ->helperText('Recherchez un utilisateur existant par son email.')
                            ->required(),
                        Select::make('property_id')
                            ->label('Propriété')
                            ->relationship('property', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('start_date')
                            ->label('Date d\'arrivée')
                            ->required()
                            ->native(false),
                        DatePicker::make('end_date')
                            ->label('Date de départ')
                            ->required()
                            ->afterOrEqual('start_date')
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('property.name')
                    ->label('Propriété')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Arrivée')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Départ')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('property')
                    ->label('Propriété')
                    ->relationship('property', 'name')
                    ->searchable(),
                SelectFilter::make('user')
                    ->label('Client')
                    ->relationship('user', 'name')
                    ->searchable(),
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
        return 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
