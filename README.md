# Laravel Test Technique

Application de gestion de réservations immobilières construite à partir du squelette généré avec :

```bash
composer create-project laravel/laravel laravel-test
```

Le projet a ensuite été enrichi pour couvrir un cas complet de réservations de biens immobiliers avec espace client, administration, Livewire et personnalisation du profil utilisateur.

## Objectif du projet

Le site permet de :
- consulter un catalogue public de biens immobiliers ;
- ouvrir la fiche détaillée d'un bien ;
- réserver un bien via un module Livewire ;
- consulter ses réservations depuis un tableau de bord client ;
- administrer les biens, utilisateurs et réservations depuis un panneau Filament.

## Dépendances ajoutées

### Dépendances PHP principales

Les ajouts majeurs par rapport au projet Laravel initial sont :
- `filament/filament` : panneau d'administration.
- `livewire/livewire` : interactions dynamiques sans écrire un front SPA complet.
- `laravel/breeze` : authentification Blade simple pour le parcours utilisateur.

Dépendances présentes dans `composer.json` :
- `php: ^8.3`
- `laravel/framework: ^13.0`
- `laravel/tinker: ^3.0`
- `filament/filament: ^5.4`
- `livewire/livewire: ^4.2`

Dépendances de développement :
- `laravel/breeze`
- `fakerphp/faker`
- `laravel/pail`
- `laravel/pint`
- `mockery/mockery`
- `nunomaduro/collision`
- `phpunit/phpunit`

### Dépendances front

Le front repose sur :
- `tailwindcss`
- `@tailwindcss/forms`
- `vite`
- `laravel-vite-plugin`
- `alpinejs`
- `axios`
- `concurrently`

## Modifications réalisées après la création du projet

### 1. Mise en place du domaine fonctionnel

Ajouts du cœur métier du projet :
- modèle `Property` pour représenter un bien immobilier ;
- modèle `Booking` pour représenter une réservation ;
- relations entre utilisateurs, biens et réservations ;
- migrations pour `properties`, `bookings` et le `role` utilisateur ;
- seeding de données de démonstration.

Résultat : le projet ne se limite plus à une installation Laravel par défaut, il implémente un vrai mini produit de réservations.

### 2. Catalogue public des biens

Le site public a été adapté pour afficher :
- une page d'accueil personnalisée ;
- une liste de biens paginée ;
- des cartes de biens réutilisables ;
- une page détaillée pour chaque propriété.

Routes principales :
- `/`
- `/properties/{property}`

### 3. Module de réservation avec Livewire

Un composant Livewire `BookingManager` a été ajouté pour :
- choisir une date d'arrivée ;
- choisir une date de départ ;
- calculer le nombre de nuits ;
- estimer le total de la réservation ;
- enregistrer la réservation si le bien est disponible.

Le composant bloque également :
- les visiteurs non connectés, redirigés vers la connexion ;
- les administrateurs, redirigés vers l'espace admin.

### 4. Tableau de bord utilisateur

Un espace client a été ajouté avec :
- une route `/dashboard` ;
- un affichage des réservations de l'utilisateur connecté ;
- une navigation différenciée entre client et administrateur.

Cet espace est réservé aux comptes clients vérifiés.

### 5. Séparation entre espace client et espace admin

Une logique de rôle a été ajoutée dans `User` :
- `ROLE_ADMIN`
- `ROLE_CUSTOMER`
- méthode `isAdmin()`
- méthode `canAccessPanel()` pour Filament

Un middleware `EnsureCustomer` a été ajouté pour empêcher un administrateur d'accéder :
- au tableau de bord client ;
- au profil client.

Après connexion :
- un admin est redirigé vers `/admin` ;
- un client est redirigé vers `/dashboard`.

### 6. Panneau d'administration Filament

Un panneau admin Filament a été configuré sur :
- `/admin`

Il permet d'administrer :
- les biens ;
- les réservations ;
- les utilisateurs.

Des widgets ont été ajoutés pour afficher :
- des statistiques globales ;
- des réservations récentes.

Seuls les utilisateurs ayant le rôle `admin` peuvent accéder à cet espace.

### 7. Gestion de la photo de profil

Le profil utilisateur a été enrichi avec :
- un champ `profile_photo_path` en base ;
- un formulaire `multipart/form-data` ;
- l'upload d'une photo dans `storage/app/public/profile-photos` ;
- la suppression de la photo existante ;
- une image par défaut si aucune photo n'est définie ;
- l'affichage de la photo dans la page profil et dans la navigation.

Points techniques associés :
- migration `add_profile_photo_path_to_users_table` ;
- mise à jour de `ProfileController` ;
- validation dans `ProfileUpdateRequest` ;
- méthode `profilePhotoUrl()` dans `User`.

### 8. Personnalisation de l'interface

Plusieurs vues ont été retravaillées pour sortir du rendu Laravel par défaut :
- `welcome.blade.php`
- `navigation.blade.php`
- `profile/edit.blade.php`
- `profile/partials/update-profile-information-form.blade.php`
- `livewire/booking-manager.blade.php`

L'interface inclut maintenant :
- une page d'accueil personnalisée ;
- une navigation adaptée aux rôles ;
- un profil utilisateur enrichi ;
- un parcours de réservation plus clair.

## Comptes de démonstration

Après exécution du seeder, les comptes suivants sont disponibles :

### Admin
- Email : `admin@example.com`
- Mot de passe : `password`
- URL : `http://127.0.0.1:8000/admin/login`

### Client
- Email : `test@example.com`
- Mot de passe : `password`

## Installation

### 1. Installer les dépendances PHP

```bash
composer install
```

### 2. Installer les dépendances front

```bash
npm install
```

### 3. Configurer l'environnement

Copier `.env.example` vers `.env`, puis configurer la base de données.

Générer ensuite la clé d'application :

```bash
php artisan key:generate
```

### 4. Exécuter les migrations et charger les données de test

```bash
php artisan migrate:fresh --seed
```

### 5. Créer le lien de stockage public pour les photos

```bash
php artisan storage:link
```

### 6. Lancer le projet

Option recommandée :

```bash
composer run dev
```

Ou manuellement :

```bash
php artisan serve
npm run dev
```

## Tests

```bash
php artisan test
```

## Structure des fichiers principalement modifiés

### Backend
- `app/Models/User.php`
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `app/Http/Requests/ProfileUpdateRequest.php`
- `app/Http/Middleware/EnsureCustomer.php`
- `app/Livewire/BookingManager.php`
- `app/Providers/Filament/AdminPanelProvider.php`

### Routes
- `routes/web.php`

### Base de données
- `database/factories/PropertyFactory.php`
- `database/seeders/DatabaseSeeder.php`
- `database/migrations/...create_properties_table.php`
- `database/migrations/...create_bookings_table.php`
- `database/migrations/...add_role_to_users_table.php`
- `database/migrations/2026_03_30_090000_add_profile_photo_path_to_users_table.php`

### Vues
- `resources/views/welcome.blade.php`
- `resources/views/layouts/navigation.blade.php`
- `resources/views/profile/edit.blade.php`
- `resources/views/profile/partials/update-profile-information-form.blade.php`
- `resources/views/livewire/booking-manager.blade.php`

## Résumé

À partir d'un projet Laravel vide, les évolutions principales ont été :
- ajout de Breeze pour l'authentification ;
- ajout de Livewire pour la réservation dynamique ;
- ajout de Filament pour l'administration ;
- création d'un mini domaine métier immobilier ;
- séparation stricte entre comptes clients et comptes admins ;
- ajout de la gestion de photo de profil ;
- personnalisation importante des vues Blade.
