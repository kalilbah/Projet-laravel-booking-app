# Laravel Test Technique

Application de gestion de reservations immobilieres construite a partir du squelette cree avec :

```bash
composer create-project laravel/laravel laravel-test
```

Le projet a ensuite ete enrichi pour couvrir un cas complet de reservations de biens immobiliers avec espace client, panneau d administration Filament, module de reservation Livewire et personnalisation du profil utilisateur.

## Objectif du projet

Le site permet de :
- consulter un catalogue public de biens immobiliers ;
- ouvrir la fiche detaillee d un bien ;
- reserver un bien via un module Livewire ;
- consulter, gerer et annuler ses reservations depuis un espace utilisateur ;
- administrer les biens, les clients et les reservations depuis un panneau Filament.

## Dependances ajoutees

### Dependances PHP principales
- `laravel/framework:^13.0`
- `laravel/tinker:^3.0`
- `livewire/livewire:^4.2`
- `filament/filament:^5.4`

### Dependances de developpement
- `laravel/breeze:^2.4`
- `fakerphp/faker:^1.23`
- `laravel/pail:^1.2.5`
- `laravel/pint:^1.27`
- `mockery/mockery:^1.6`
- `nunomaduro/collision:^8.6`
- `phpunit/phpunit:^12.5.12`

### Dependances front
- `tailwindcss`
- `@tailwindcss/forms`
- `vite`
- `laravel-vite-plugin`
- `alpinejs`
- `axios`
- `concurrently`

## Evolutions apportees apres la creation du projet

### Fonctionnalites metier
- ajout des modeles `Property` et `Booking` ;
- mise en place des relations entre utilisateurs, biens et reservations ;
- ajout des migrations pour les biens, les reservations, le role utilisateur et la photo de profil ;
- generation de donnees de demonstration via factories et seeders.

### Espace public
- page d accueil personnalisee ;
- catalogue public des biens ;
- fiche detaillee pour chaque propriete ;
- navigation adaptee selon le statut de connexion.

### Espace utilisateur
- tableau de bord personnel ;
- affichage des reservations du compte connecte ;
- bouton d annulation d une reservation ;
- gestion du profil avec photo.

### Reservation avec Livewire
- choix des dates d arrivee et de depart ;
- estimation dynamique du sejour ;
- validation et enregistrement de la reservation ;
- blocage des reservations pour les visiteurs non connectes et pour les administrateurs.

### Administration avec Filament
- panneau disponible sur `/admin` ;
- gestion des biens ;
- gestion des reservations ;
- separation entre `Clients` et `Administrateurs` ;
- liste des administrateurs en lecture seule ;
- creation de reservation admin avec attribution a un utilisateur existant recherche par email.

### Gestion des roles
- `admin` pour l espace Filament ;
- `customer` pour l espace utilisateur ;
- redirection automatique apres connexion selon le role ;
- protection des routes utilisateur via le middleware `EnsureCustomer`.

### Gestion de la photo de profil
- ajout du champ `profile_photo_path` ;
- upload d image dans `storage/app/public/profile-photos` ;
- suppression de la photo existante ;
- avatar par defaut si aucune photo n est definie ;
- affichage de la photo dans la navigation et sur la page profil.

## Comptes de demonstration

### Admin
- Email : `admin@example.com`
- Mot de passe : `password`
- URL : `http://127.0.0.1:8000/admin/login`

### Client
- Email : `test@example.com`
- Mot de passe : `password`

## Installation

### 1. Installer les dependances PHP
```bash
composer install
```

### 2. Installer les dependances front
```bash
npm install
```

### 3. Configurer l environnement
Copier `.env.example` vers `.env`, puis configurer la base de donnees.

Generer ensuite la cle d application :
```bash
php artisan key:generate
```

### 4. Executer les migrations et charger les donnees de test
```bash
php artisan migrate:fresh --seed
```

### 5. Creer le lien de stockage public pour les photos
```bash
php artisan storage:link
```

### 6. Lancer le projet
Option recommandee :
```bash
composer run dev
```

Ou manuellement :
```bash
php artisan serve
npm run dev
```

## Captures d ecran

### 1. Page d accueil
Vue d ensemble du catalogue public avec les biens disponibles et l acces aux principales actions du site.

<img src="./screenshot/pageAcceuil.png" alt="Page d accueil" width="100%">

### 2. Connexion client
Formulaire de connexion pour un utilisateur classique avant acces au tableau de bord et aux reservations.

<img src="./screenshot/login-client.png" alt="Connexion client" width="100%">

### 3. Tableau de bord utilisateur
Espace membre permettant de consulter ses reservations, acceder a son profil et gerer son parcours client.

<img src="./screenshot/tableau-de-bord.png" alt="Tableau de bord utilisateur" width="100%">

### 4. Fiche detaillee et reservation
Page detaillee d un bien avec le module Livewire permettant de choisir les dates et envoyer une reservation.

<img src="./screenshot/faireUneReservation.png" alt="Faire une reservation" width="100%">

### 5. Gestion du profil
Page de profil avec affichage de la photo, des informations du compte et possibilite de modifier ses donnees.

<img src="./screenshot/gestionduprofil.png" alt="Gestion du profil" width="100%">

### 6. Tableau de bord admin
Vue principale du panneau Filament avec les indicateurs de suivi de l application.

<img src="./screenshot/dashboard-admin.png" alt="Dashboard admin" width="100%">

### 7. Liste des administrateurs
Vue de consultation des administrateurs dans Filament. Cette section est volontairement en lecture seule.

<img src="./screenshot/administrateur.png" alt="Administrateurs" width="100%">

### 8. Gestion des clients par l admin
Liste des clients gerables depuis l espace d administration.

<img src="./screenshot/gestion-clients-admin.png" alt="Gestion des clients" width="100%">

### 9. Edition d un client
Formulaire d edition d un compte client dans l interface d administration.

<img src="./screenshot/editClient.png" alt="Edition d un client" width="100%">

### 10. Gestion des proprietes cote admin
Liste des biens immobiliers dans Filament avec acces aux operations d administration.

<img src="./screenshot/proprietes-admin.png" alt="Proprietes cote admin" width="100%">

### 11. Edition d une propriete
Formulaire de modification d un bien immobilier dans l interface admin.

<img src="./screenshot/edit-propriete.png" alt="Edition d une propriete" width="100%">

### 12. Gestion des reservations cote admin
Liste des reservations visibles dans le panneau d administration.

<img src="./screenshot/reservations-admin.png" alt="Reservations cote admin" width="100%">

### 13. Creation d une reservation par l admin
Formulaire Filament de creation d une reservation avec attribution a un utilisateur existant via recherche par email.

<img src="./screenshot/create-reservation.png" alt="Creation d une reservation" width="100%">

## Principaux fichiers modifies ou ajoutes

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

### Base de donnees
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

## Resume

A partir d un projet Laravel vide, ce projet est devenu une application complete de reservations immobilieres avec :
- authentification Breeze ;
- reservations dynamiques avec Livewire ;
- administration avec Filament ;
- separation claire entre clients et administrateurs ;
- gestion de la photo de profil ;
- interface personnalisee en Blade et TailwindCSS.
