@extends('layouts.app')

@section('header')
    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-primary">Gestion locative</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">
                Consultez nos biens, choisissez vos dates et gerez vos reservations en quelques clics.
            </h1>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            {{-- Bloc de synthese pour mettre en avant le nombre de biens disponibles. --}}
            <div class="rounded-3xl border border-white/70 bg-white/90 p-5 shadow-sm">
                <p class="text-sm text-slate-500">Biens publies</p>
                <p class="mt-2 text-3xl font-bold text-slate-950">{{ $properties->total() }}</p>
            </div>
            {{-- Bloc d acces rapide vers les principales zones du projet. --}}
            <div class="rounded-3xl border border-white/70 bg-slate-950 p-5 text-white shadow-sm">
                <p class="text-sm text-slate-300">Acces rapide</p>
                <p class="mt-2 text-lg font-semibold">Admin, reservations, tableau de bord</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="space-y-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-950">Nos proprietes</h2>
                <p class="mt-1 text-slate-600">Chaque carte permet d'acceder a la fiche detaillee et au module de reservation.</p>
            </div>

            @auth
                {{-- Bouton affiche pour un utilisateur connecte afin d acceder a ses reservations. --}}
                <x-ui.button href="{{ route('dashboard') }}" variant="secondary" size="md">
                    Voir mes reservations
                </x-ui.button>
            @else
                {{-- Bouton affiche pour inviter un visiteur a creer un compte. --}}
                <x-ui.button href="{{ route('register') }}" variant="secondary" size="md">
                    Creer un compte
                </x-ui.button>
            @endauth
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($properties as $property)
                <x-ui.property-card :property="$property" />
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                    Aucune propriete disponible pour le moment.
                </div>
            @endforelse
        </div>

        <div>
            {{ $properties->links() }}
        </div>
    </section>
@endsection
