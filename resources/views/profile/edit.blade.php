<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-primary">Mon compte</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">
                    Gérer votre profil
                </h2>
            </div>

            {{-- Carte de rappel avec l'adresse e-mail du compte connecté. --}}
            <div class="rounded-3xl border border-white/70 bg-white/80 px-5 py-4 shadow-sm backdrop-blur">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Compte</p>
                <p class="mt-1 text-base font-semibold text-slate-950">{{ $user->email }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[320px_minmax(0,1fr)] lg:px-8">
            {{-- Colonne de présentation du profil avec photo, nom et statut du compte. --}}
            <aside class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col items-center text-center">
                    <img src="{{ $user->profilePhotoUrl() }}" alt="Photo de profil de {{ $user->name }}" class="h-28 w-28 rounded-full object-cover ring-4 ring-primary/10">

                    <h3 class="mt-5 text-xl font-semibold text-slate-950">{{ $user->name }}</h3>
                    <p class="mt-1 text-sm text-slate-500">{{ $user->email }}</p>

                    <div class="mt-5 w-full rounded-2xl bg-slate-50 px-4 py-4 text-left">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Statut</p>
                        <p class="mt-2 text-sm font-medium text-slate-700">
                            {{ $user->hasVerifiedEmail() ? 'Adresse e-mail vérifiée' : 'Adresse e-mail en attente de vérification' }}
                        </p>
                    </div>
                </div>
            </aside>

            {{-- Colonne des formulaires de mise à jour du compte. --}}
            <div class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="rounded-3xl border border-rose-100 bg-white p-6 shadow-sm sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>