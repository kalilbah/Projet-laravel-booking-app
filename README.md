# Laravel Test Technique

Application de gestion de réservations immobilières construite à partir du squelette créé avec :

```bash
composer create-project laravel/laravel laravel-test
```

Le projet a ensuite été enrichi pour couvrir un cas complet de réservations de biens immobiliers avec espace client, panneau d'administration Filament, module de réservation Livewire et personnalisation du profil utilisateur.

## Objectif du projet

Le site permet de :

- consulter un catalogue public de biens immobiliers ;
- ouvrir la fiche détaillée d'un bien ;
- réserver un bien via un module Livewire ;
- consulter, gérer et annuler ses réservations depuis un espace utilisateur ;
- administrer les biens, les clients et les réservations depuis un panneau Filament.

## Dépendances ajoutées

### Dépendances PHP principales

- `laravel/framework:^13.0`
- `laravel/tinker:^3.0`
- `livewire/livewire:^4.2`
- `filament/filament:^5.4`

### Dépendances de développement

- `laravel/breeze:^2.4`
- `fakerphp/faker:^1.23`
- `laravel/pail:^1.2.5`
- `laravel/pint:^1.27`
- `mockery/mockery:^1.6`
- `nunomaduro/collision:^8.6`
- `phpunit/phpunit:^12.5.12`

### Dépendances front

- `tailwindcss`
- `@tailwindcss/forms`
- `vite`
- `laravel-vite-plugin`
- `alpinejs`
- `axios`
- `concurrently`

## Évolutions apportées après la création du projet

### Fonctionnalités métier

- ajout des modèles `Property` et `Booking` ;
- mise en place des relations entre utilisateurs, biens et réservations ;
- ajout des migrations pour les biens, les réservations, le rôle utilisateur et la photo de profil ;
- génération de données de démonstration via factories et seeders.

### Espace public

- page d'accueil personnalisée ;
- catalogue public des biens ;
- fiche détaillée pour chaque propriété ;
- navigation adaptée selon le statut de connexion.

### Espace utilisateur

- tableau de bord personnel ;
- affichage des réservations du compte connecté ;
- bouton d'annulation d'une réservation ;
- gestion du profil avec photo.

### Réservation avec Livewire

- choix des dates d'arrivée et de départ ;
- estimation dynamique du séjour ;
- validation et enregistrement de la réservation ;
- blocage des réservations pour les visiteurs non connectés et pour les administrateurs.

### Administration avec Filament

- panneau disponible sur `/admin` ;
- gestion des biens ;
- gestion des réservations ;
- séparation entre `Clients` et `Administrateurs` ;
- liste des administrateurs en lecture seule ;
- création de réservation admin avec attribution à un utilisateur existant recherché par email.

### Gestion des rôles

- `admin` pour l'espace Filament ;
- `customer` pour l'espace utilisateur ;
- redirection automatique après connexion selon le rôle ;
- protection des routes utilisateur via le middleware `EnsureCustomer`.

### Gestion de la photo de profil

- ajout du champ `profile_photo_path` ;
- upload d'image dans `storage/app/public/profile-photos` ;
- suppression de la photo existante ;
- avatar par défaut si aucune photo n'est définie ;
- affichage de la photo dans la navigation et sur la page profil.

## Comptes de démonstration

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

## Captures d'écran

### 1. Page d'accueil

Vue d'ensemble du catalogue public avec les biens disponibles et l'accès aux principales actions du site.

![Page d'accueil](screenshot/pageAcceuil.png)

### 2. Connexion client

Formulaire de connexion pour un utilisateur classique avant accès au tableau de bord et aux réservations.

![Connexion client](screenshot/login%20client.png)

### 3. Tableau de bord utilisateur

Espace membre permettant de consulter ses réservations, accéder à son profil et gérer son parcours client.

![Tableau de bord utilisateur](screenshot/tableauDeBord.png)

### 4. Fiche détaillée et réservation

Page détaillée d'un bien avec le module Livewire permettant de choisir les dates et envoyer une réservation.

![Faire une réservation](screenshot/faireUneReservation.png)

### 5. Gestion du profil

Page de profil avec affichage de la photo, des informations du compte et possibilité de modifier ses données.

![Gestion du profil](screenshot/gestionduprofil.png)

### 6. Tableau de bord admin

Vue principale du panneau Filament avec les indicateurs de suivi de l'application.

![Dashboard admin](screenshot/DashboardAdmin.png)

### 7. Liste des administrateurs

Vue de consultation des administrateurs dans Filament. Cette section est volontairement en lecture seule.

![Administrateurs](screenshot/administrateur.png)

### 8. Gestion des clients par l'admin

Liste des clients gérables depuis l'espace d'administration.

![Gestion des clients](screenshot/gestion%20de%20clien%20par%20admin.png)

### 9. Édition d'un client

Formulaire d'édition d'un compte client dans l'interface d'administration.

![Édition d'un client](screenshot/editClient.png)

### 10. Gestion des propriétés côté admin

Liste des biens immobiliers dans Filament avec accès aux opérations d'administration.

![Propriétés côté admin](screenshot/proprietesCot%C3%A9Admin.png)

### 11. Édition d'une propriété

Formulaire de modification d'un bien immobilier dans l'interface admin.

![Édition d'une propriété](screenshot/editProprit%C3%A9.png)

### 12. Gestion des réservations côté admin

Liste des réservations visibles dans le panneau d'administration.

![Réservations côté admin](screenshot/reservation%20cote%20admin.png)

### 13. Création d'une réservation par l'admin

Formulaire Filament de création d'une réservation avec attribution à un utilisateur existant via recherche par email.

![Création d'une réservation](screenshot/create%20reservation%20.png)

## Principaux fichiers modifiés ou ajoutés

### Backend

- `app/Models/User.php`
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `app/Http/Controllers/UserBookingController.php`
- `app/Http/Requests/ProfileUpdateRequest.php`
- `app/Http/Middleware/EnsureCustomer.php`
- `app/Livewire/BookingManager.php`
- `app/Providers/Filament/AdminPanelProvider.php`
- `app/Filament/Resources/UserResource.php`
- `app/Filament/Resources/AdminResource.php`
- `app/Filament/Resources/BookingResource.php`

### Routes

- `routes/web.php`

### Base de données

- `database/factories/PropertyFactory.php`
- `database/seeders/DatabaseSeeder.php`
- `database/migrations/2026_03_26_152144_create_properties_table.php`
- `database/migrations/2026_03_26_152200_create_bookings_table.php`
- `database/migrations/2026_03_27_164500_add_role_to_users_table.php`
- `database/migrations/2026_03_30_090000_add_profile_photo_path_to_users_table.php`

### Vues

- `resources/views/welcome.blade.php`
- `resources/views/layouts/navigation.blade.php`
- `resources/views/dashboard.blade.php`
- `resources/views/properties/show.blade.php`
- `resources/views/profile/edit.blade.php`
- `resources/views/profile/partials/update-profile-information-form.blade.php`
- `resources/views/livewire/booking-manager.blade.php`

### Assets

- `public/images/default-profile.svg`
- dossier `screenshot/`

## Tests

```bash
php artisan test
```

## Résumé

À partir d'un projet Laravel vide, ce projet est devenu une application complète de réservations immobilières avec :

- authentification Breeze ;
- réservations dynamiques avec Livewire ;
- administration avec Filament ;
- séparation claire entre clients et administrateurs ;
- gestion de la photo de profil ;
- interface personnalisée en Blade et TailwindCSS.
