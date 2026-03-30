@props(['property'])

<article class="group flex h-full flex-col rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Bien immobilier</p>
            <h3 class="mt-3 text-xl font-semibold text-slate-950">{{ $property->name }}</h3>
        </div>
        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
            {{ $property->bookings_count ?? $property->bookings->count() }} reservation(s)
        </span>
    </div>

    <p class="mt-4 flex-1 text-sm leading-6 text-slate-600">
        {{ \Illuminate\Support\Str::limit($property->description, 160) }}
    </p>

    <div class="mt-6 flex items-center justify-between gap-4 border-t border-slate-100 pt-5">
        <div>
            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Tarif</p>
            <p class="mt-1 text-xl font-bold text-primary">{{ number_format((float) $property->price_per_night, 2, ',', ' ') }} EUR</p>
        </div>

        <x-ui.button href="{{ route('properties.show', $property) }}" variant="secondary" size="sm">
            Reserver
        </x-ui.button>
    </div>
</article>
