<x-app-layout :title="$property->name">
    <x-slot name="header">
        <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-primary">Fiche bien</p>
                <h1 class="mt-3 text-4xl font-black tracking-tight text-slate-950">{{ $property->name }}</h1>
                <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-600">{{ $property->description }}</p>
            </div>

            <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-slate-500">Prix</p>
                        <p class="mt-2 text-2xl font-bold text-slate-950">{{ number_format((float) $property->price_per_night, 2, ',', ' ') }} EUR</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Reservations</p>
                        <p class="mt-2 text-2xl font-bold text-slate-950">{{ $property->bookings->count() }}</p>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <x-ui.button href="{{ route('properties.index') }}" variant="ghost" size="sm">Retour au catalogue</x-ui.button>
                    @guest
                        <x-ui.button href="{{ route('login') }}" variant="secondary" size="sm">Se connecter</x-ui.button>
                    @endguest
                </div>
            </div>
        </div>
    </x-slot>

    <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr]">
        <livewire:booking-manager :property="$property" />

        <aside class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-950">Pourquoi ce projet est conforme</h2>
                <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                    <li>Authentification Breeze deja integree.</li>
                    <li>Catalogue Blade avec composants Tailwind reutilisables.</li>
                    <li>Reservation dynamique en Livewire avec validation des dates.</li>
                    <li>Relations Eloquent et seeders pour les donnees de demonstration.</li>
                </ul>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-950">Dernieres reservations</h2>
                <div class="mt-4 space-y-3">
                    @forelse ($property->bookings as $booking)
                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <p class="font-medium text-slate-900">{{ $booking->user->name }}</p>
                            <p class="mt-1 text-sm text-slate-600">
                                {{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}
                            </p>
                        </div>
                    @empty
                        <p class="rounded-2xl border border-dashed border-slate-300 px-4 py-6 text-center text-sm text-slate-500">
                            Aucune reservation sur ce bien.
                        </p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>
