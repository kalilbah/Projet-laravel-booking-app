<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-secondary">Espace membre</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Tableau de bord reservations</h1>
                <p class="mt-2 text-slate-600">Suivi rapide des biens disponibles et de vos prochaines reservations.</p>
            </div>
            <x-ui.button href="{{ route('properties.index') }}" variant="primary" size="md">Explorer les biens</x-ui.button>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
        <section class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Reservations totales</p>
                <p class="mt-2 text-4xl font-black text-slate-950">{{ $userBookings->count() }}</p>
                <p class="mt-2 text-sm text-slate-600">Toutes vos reservations enregistrees via le module Livewire.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-950">Acces utiles</h2>
                <div class="mt-4 flex flex-wrap gap-3">
                    <x-ui.button href="{{ route('properties.index') }}" variant="ghost" size="sm">Catalogue public</x-ui.button>
                    <x-ui.button href="{{ route('profile.edit') }}" variant="ghost" size="sm">Mon profil</x-ui.button>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-950">Mes prochaines reservations</h2>
                    <p class="mt-1 text-sm text-slate-600">Liste des sejours relies a votre compte.</p>
                </div>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">{{ $userBookings->count() }}</span>
            </div>

            <div class="mt-5 space-y-3">
                @forelse ($userBookings as $booking)
                    <div class="rounded-2xl border border-slate-200 px-4 py-4">
                        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <div>
                                <p class="font-semibold text-slate-950">{{ $booking->property->name }}</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Du {{ $booking->start_date->format('d/m/Y') }} au {{ $booking->end_date->format('d/m/Y') }}
                                </p>
                            </div>
                            <x-ui.button href="{{ route('properties.show', $booking->property) }}" variant="secondary" size="sm">
                                Voir le bien
                            </x-ui.button>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">
                        Vous n'avez pas encore de reservation.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>
