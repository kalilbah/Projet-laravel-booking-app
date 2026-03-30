<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages\CreateBooking;
use App\Filament\Resources\BookingResource\Pages\EditBooking;
use App\Filament\Resources\BookingResource\Pages\ListBookings;
use App\Models\Booking;
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

    protected static string | UnitEnum | null $navigationGroup = 'Reservations';

    protected static ?string $navigationLabel = 'Reservations';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'reservation';

    protected static ?string $pluralModelLabel = 'reservations';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reservation')
                    ->schema([
                        Select::make('user_id')
                            ->label('Utilisateur')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('property_id')
                            ->label('Propriete')
                            ->relationship('property', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('start_date')
                            ->label('Date d\'arrivee')
                            ->required()
                            ->native(false),
                        DatePicker::make('end_date')
                            ->label('Date de depart')
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
                    ->label('Propriete')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Arrivee')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Depart')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Cree le')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('property')
                    ->label('Propriete')
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
