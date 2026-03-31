<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Ajout des champs liés au rôle et à la photo de profil.
#[Fillable(['name', 'email', 'password', 'role', 'profile_photo_path'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Rôle utilisé pour l'accès au panneau d'administration.
    public const ROLE_ADMIN = 'admin';

    // Rôle par défaut pour les utilisateurs du site.
    public const ROLE_CUSTOMER = 'customer';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Autorise uniquement les comptes admin à entrer dans Filament.
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    // Vérifie si l'utilisateur courant possède le rôle admin.
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Retourne la photo uploadée ou une image par défaut si aucune photo n'existe.
    public function profilePhotoUrl(): string
    {
        if ($this->profile_photo_path) {
            return '/storage/' . $this->profile_photo_path;
        }

        return '/images/default-profile.svg';
    }

    // Conserve un fallback textuel réutilisable si besoin ailleurs dans l'interface.
    public function initials(): string
    {
        return str($this->name)
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn(string $part) => str($part)->substr(0, 1)->upper())
            ->implode('');
    }
}
