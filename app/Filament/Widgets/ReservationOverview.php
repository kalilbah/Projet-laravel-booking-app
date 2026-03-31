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
            Stat::make('Réservations', Booking::query()->count())
                ->description('Total des séjours enregistrés')
                ->color('success'),
            Stat::make('Clients', User::query()->count())
                ->description('Comptes utilisateurs')
                ->color('warning'),
            Stat::make('Séjours à venir', Booking::query()->whereDate('start_date', '>=', now()->toDateString())->count())
                ->description('Réservations futures')
                ->color('info'),
        ];
    }
}
