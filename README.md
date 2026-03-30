# Laravel Test Technique

Application de gestion de reservations immobilieres realisee avec Laravel, Breeze, Livewire et TailwindCSS.

## Fonctionnalites

<!-- Resume rapide des briques fonctionnelles mises en place dans le projet. -->
- Authentification Breeze en Blade.
- Catalogue public des biens immobiliers.
- Fiche detaillee par bien avec module de reservation Livewire.
- Tableau de bord utilisateur pour consulter ses reservations.
- Composants Blade reutilisables pour les boutons et les cartes.
- Seeders et factories pour generer des donnees de demonstration.

## Installation

<!-- Etapes minimales pour installer, initialiser et lancer le projet localement. -->
1. Installer les dependances PHP:

```bash
composer install
```

2. Installer les dependances front:

```bash
npm install
```

3. Configurer `.env`, puis generer la cle:

```bash
php artisan key:generate
```

4. Lancer la base et les donnees de test:

```bash
php artisan migrate:fresh --seed
```

5. Demarrer le projet:

```bash
composer run dev
```

## Compte de demonstration

<!-- Comptes fournis pour tester rapidement le parcours client et l espace admin. -->
- Admin Filament: `admin@example.com` / `password`
- Email: `test@example.com`
- Mot de passe client: `password`

## Tests

```bash
php artisan test
```

## Filament

<!-- Precision sur l'acces au panneau d administration. -->
Le panneau d'administration est disponible sur `/admin`.
Seuls les utilisateurs avec le role `admin` peuvent y acceder.
