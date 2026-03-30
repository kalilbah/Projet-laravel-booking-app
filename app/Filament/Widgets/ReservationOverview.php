<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Biens', Property::query()->count())
                ->description('Catalogue administrable')
                ->color('primary'),
            Stat::make('Reservations', Booking::query()->count())
                ->description('Total des sejours enregistres')
                ->color('success'),
            Stat::make('Clients', User::query()->count())
                ->description('Comptes utilisateurs')
                ->color('warning'),
            Stat::make('Sejours a venir', Booking::query()->whereDate('start_date', '>=', now()->toDateString())->count())
                ->description('Reservations futures')
                ->color('info'),
        ];
    }
}
