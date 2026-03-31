<section>
    <header>
        <h2 class="text-lg font-semibold text-slate-950">
            Informations du profil
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Modifiez votre nom, votre adresse e-mail et votre photo de profil.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Le formulaire accepte maintenant l'envoi d'une image de profil. --}}
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-6 lg:grid-cols-[220px_minmax(0,1fr)] lg:items-start">
            {{-- Bloc d'aperçu de la photo actuellement associée au compte. --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-medium text-slate-700">Photo actuelle</p>

                <div class="mt-4 flex justify-center">
                    <img src="{{ $user->profilePhotoUrl() }}" alt="Photo de profil" class="h-24 w-24 rounded-full object-cover">
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    {{-- Champ d'upload pour ajouter ou remplacer la photo de profil. --}}
                    <x-input-label for="profile_photo" value="Photo de profil" />
                    <input id="profile_photo" name="profile_photo" type="file" accept="image/*" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary focus:ring-primary">
                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                </div>

                @if ($user->profile_photo_path)
                {{-- Option pour supprimer explicitement la photo enregistrée. --}}
                <label class="inline-flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remove_profile_photo" value="1" class="rounded border-slate-300 text-primary shadow-sm focus:ring-primary">
                    Supprimer la photo actuelle
                </label>
                @endif

                <div>
                    <x-input-label for="name" value="Nom complet" />
                    <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" value="Adresse e-mail" />
                    <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-slate-700">
                            Votre adresse e-mail n'est pas encore vérifiée.

                            <button form="send-verification" class="ml-1 underline text-sm text-slate-600 hover:text-slate-950 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Renvoyer le lien de vérification
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-emerald-600">
                            Un nouveau lien de vérification vous a été envoyé.
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Enregistrer</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-slate-600">Modifications enregistrées.</p>
            @endif
        </div>
    </form>
</section>