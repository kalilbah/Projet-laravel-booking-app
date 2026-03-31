<nav x-data="{ open: false }" class="border-b border-white/60 bg-white/80 backdrop-blur">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">
            <a href="{{ route('properties.index') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-primary text-lg font-bold text-white shadow-lg shadow-blue-950/20">
                    IQ
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-500">InnovQube</p>
                    <p class="text-base font-semibold text-slate-950">{{ config('app.name', 'Laravel') }}</p>
                </div>
            </a>

            <div class="hidden items-center gap-2 md:flex">
                <a href="{{ route('properties.index') }}" class="rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('properties.*') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                    Biens
                </a>
                @auth
                @if (Auth::user()->isAdmin())
                {{-- Lien réservé aux comptes administrateurs vers le panneau Filament. --}}
                <a href="/admin" class="rounded-full px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-950">
                    Administration
                </a>
                @else
                {{-- Lien client vers le tableau de bord des réservations. --}}
                <a href="{{ route('dashboard') }}" class="rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-secondary text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                    Tableau de bord
                </a>
                @endif
                @endauth
            </div>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            @auth
            @if (Auth::user()->isAdmin())
            <a href="/admin" class="text-sm font-medium text-slate-600 transition hover:text-slate-950">
                Administration
            </a>
            @else
            {{-- La photo de profil remplace ici l'ancien lien texte avec le nom de l'utilisateur. --}}
            <a href="{{ route('profile.edit') }}" class="inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full ring-2 ring-slate-200 transition hover:ring-primary/40" aria-label="Accéder au profil">
                <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="Photo de profil de {{ Auth::user()->name }}" class="h-full w-full object-cover">
            </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-ui.button type="submit" variant="ghost" size="sm">Se déconnecter</x-ui.button>
            </form>
            @else
            <x-ui.button href="{{ route('login') }}" variant="ghost" size="sm">Connexion</x-ui.button>
            <x-ui.button href="{{ route('register') }}" variant="secondary" size="sm">Inscription</x-ui.button>
            @endauth
        </div>

        <button @click="open = ! open" class="inline-flex items-center justify-center rounded-full border border-slate-200 p-2 text-slate-600 md:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16M4 12h16M4 17h16" />
                <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>
    </div>

    <div x-cloak x-show="open" class="border-t border-slate-200 bg-white px-4 py-4 md:hidden">
        <div class="space-y-2">
            <a href="{{ route('properties.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Biens</a>
            @auth
            @if (Auth::user()->isAdmin())
            <a href="/admin" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Administration</a>
            @else
            <a href="{{ route('dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Tableau de bord</a>
            {{-- Version mobile du lien profil avec affichage de la photo. --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">
                <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="Photo de profil de {{ Auth::user()->name }}" class="h-9 w-9 rounded-full object-cover">
                <span>Profil</span>
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full rounded-2xl px-4 py-3 text-left text-sm font-medium text-slate-700 hover:bg-slate-100">Se déconnecter</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Connexion</a>
            <a href="{{ route('register') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Inscription</a>
            @endauth
        </div>
    </div>
</nav>