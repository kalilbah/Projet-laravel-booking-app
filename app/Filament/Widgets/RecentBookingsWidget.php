<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentBookingsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()
                    ->with(['user', 'property'])
                    ->latest('start_date')
                    ->limit(8)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                TextColumn::make('property.name')
                    ->label('Propriété')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Arrivée')
                    ->date('d/m/Y')
                    ->icon(Heroicon::OutlinedCalendarDays),
                TextColumn::make('end_date')
                    ->label('Départ')
                    ->date('d/m/Y'),
                TextColumn::make('created_at')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(function ($state, Booking $record): string {
                        if ($record->start_date->isFuture()) {
                            return 'À venir';
                        }

                        if ($record->end_date->isPast()) {
                            return 'Terminé';
                        }

                        return 'En cours';
                    })
                    ->color(function ($state, Booking $record): string {
                        if ($record->start_date->isFuture()) {
                            return 'info';
                        }

                        if ($record->end_date->isPast()) {
                            return 'gray';
                        }

                        return 'success';
                    }),
            ]);
    }
}
