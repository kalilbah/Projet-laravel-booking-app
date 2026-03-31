<div class="space-y-6">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary">Reservation</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-950">Planifier votre sejour</h2>
                <p class="mt-2 text-sm text-slate-600">Choisissez vos dates puis confirmez votre demande en direct avec Livewire.</p>
            </div>
            <div class="rounded-2xl bg-slate-100 px-4 py-3 text-right">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Prix par nuit</p>
                <p class="mt-1 text-xl font-semibold text-slate-950">{{ number_format((float) $property->price_per_night, 2, ',', ' ') }} EUR</p>
            </div>
        </div>

        @if ($successMessage)
            <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ $successMessage }}
            </div>
        @endif

        @guest
            {{-- Message visible avant connexion pour expliquer pourquoi la reservation n est pas encore accessible. --}}
            <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                Connectez-vous pour effectuer une reservation.
            </div>
        @endguest

        @auth
            @if (auth()->user()->isAdmin())
                {{-- Rappel visuel: un administrateur peut consulter la fiche, mais pas reserver en tant que client. --}}
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    Le compte administrateur n'a pas acces a l'espace de reservation client.
                </div>
            @else
                {{-- Formulaire principal du parcours de reservation pour un utilisateur client authentifie. --}}
                <form wire:submit="save" class="mt-6 grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Date d'arrivee</span>
                        <input
                            wire:model.live="start_date"
                            type="date"
                            min="{{ now()->toDateString() }}"
                            class="mt-2 block w-full rounded-2xl border-slate-200 bg-white shadow-sm focus:border-primary focus:ring-primary">
                        @error('start_date')
                            <span class="mt-2 block text-sm text-rose-600">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Date de depart</span>
                        <input
                            wire:model.live="end_date"
                            type="date"
                            min="{{ $start_date ?: now()->toDateString() }}"
                            class="mt-2 block w-full rounded-2xl border-slate-200 bg-white shadow-sm focus:border-primary focus:ring-primary">
                        @error('end_date')
                            <span class="mt-2 block text-sm text-rose-600">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="md:col-span-2 flex flex-col gap-4 rounded-2xl bg-slate-950 px-5 py-4 text-white md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm text-slate-300">Estimation actuelle</p>
                            <p class="mt-1 text-lg font-semibold">
                                {{ $this->totalNights > 0 ? $this->totalNights.' nuit(s) - '.$this->estimatedTotal.' EUR' : 'Selectionnez vos dates' }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            {{-- Permet de vider les dates sans recharger la page. --}}
                            <button
                                type="button"
                                wire:click="clearDates"
                                class="inline-flex items-center justify-center rounded-full border border-white/30 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-slate-950">
                                Reinitialiser
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-secondary px-5 py-3 text-sm font-semibold text-white transition hover:bg-fuchsia-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2">
                                Confirmer la reservation
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        @endauth
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-slate-950">Reservations recentes</h3>
                <p class="mt-1 text-sm text-slate-600">Apercu des dernieres periodes enregistrees sur ce bien.</p>
            </div>
            <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">{{ $recentBookings->count() }} enregistree(s)</span>
        </div>

        <div class="mt-4 space-y-3">
            @forelse ($recentBookings as $booking)
                <div class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3">
                    <div>
                        <p class="font-medium text-slate-900">{{ $booking->user->name }}</p>
                        <p class="text-sm text-slate-600">
                            Du {{ $booking->start_date->format('d/m/Y') }} au {{ $booking->end_date->format('d/m/Y') }}
                        </p>
                    </div>
                    <span class="text-sm font-medium text-primary">
                        {{ $booking->start_date->diffInDays($booking->end_date) ?: 1 }} nuit(s)
                    </span>
                </div>
            @empty
                <p class="rounded-2xl border border-dashed border-slate-300 px-4 py-6 text-center text-sm text-slate-500">
                    Aucune reservation pour le moment.
                </p>
            @endforelse
        </div>
    </div>
</div>
