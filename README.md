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

### Page d accueil

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/pageAcceuil.png" alt="Page d accueil" width="900" />

Cette page presente le catalogue public de l application. Elle permet de visualiser rapidement les biens disponibles, d acceder a leur fiche detaillee et d orienter l utilisateur vers la creation de compte ou vers son espace personnel.

### Connexion client

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/login-client.png" alt="Connexion client" width="900" />

Cette interface permet a un utilisateur classique de se connecter a son compte. Elle constitue le point d entree vers l espace membre, le suivi des reservations et la gestion du profil.

### Tableau de bord utilisateur

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/tableau-de-bord.png" alt="Tableau de bord utilisateur" width="900" />

Cette page correspond a l espace utilisateur. Elle centralise les reservations du client, propose des acces rapides vers le catalogue et le profil, et permet egalement d annuler une reservation existante.

### Fiche detaillee et reservation

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/faireUneReservation.png" alt="Fiche detaillee et reservation" width="900" />

Cette page affiche le detail d un bien immobilier ainsi que le module de reservation Livewire. L utilisateur peut y selectionner ses dates, obtenir une estimation du sejour et envoyer directement sa demande de reservation.

### Gestion du profil

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/gestionduprofil.png" alt="Gestion du profil" width="900" />

Cette page est dediee a la gestion du profil utilisateur. Elle permet de modifier les informations personnelles, d ajouter ou supprimer une photo de profil, et de gerer la securite du compte.

### Tableau de bord admin

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/dashboard-admin.png" alt="Tableau de bord admin" width="900" />

Cette page constitue l accueil du panneau d administration Filament. Elle rassemble les indicateurs essentiels de l application, comme les statistiques globales et les reservations recentes.

### Interface administrateurs

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/administrateur.png" alt="Interface administrateurs" width="900" />

Cette vue liste les comptes administrateurs de l application. Elle est volontairement en lecture seule afin de distinguer la consultation des administrateurs de la gestion des comptes clients.

### Gestion des clients par l admin

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/gestion-clients-admin.png" alt="Gestion des clients par l admin" width="900" />

Cette page permet a l administrateur de consulter les comptes clients existants, de les rechercher et d acceder a leurs informations. Elle sert de point central pour la gestion des utilisateurs non administrateurs.

### Edition d un client

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/editClient.png" alt="Edition d un client" width="900" />

Cette interface permet de modifier les informations d un client depuis l espace d administration. L administrateur peut y mettre a jour les donnees du compte et suivre l etat general de l utilisateur.

### Gestion des proprietes cote admin

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/proprietes-admin.png" alt="Gestion des proprietes cote admin" width="900" />

Cette page liste les biens immobiliers disponibles dans le panneau d administration. Elle permet de gerer le catalogue, de consulter les entrees existantes et d acceder aux operations de modification.

### Edition d une propriete

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/edit-propriete.png" alt="Edition d une propriete" width="900" />

Cette page est dediee a la modification d un bien immobilier. L administrateur peut y ajuster les informations descriptives, le tarif et l ensemble des donnees necessaires a l affichage public du bien.

### Gestion des reservations cote admin

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/reservations-admin.png" alt="Gestion des reservations cote admin" width="900" />

Cette vue permet a l administrateur de consulter l ensemble des reservations enregistrees dans l application. Elle facilite le suivi global des sejours et le controle administratif des operations en cours.

### Creation d une reservation par l admin

<img src="https://raw.githubusercontent.com/kalilbah/Projet-laravel-booking-app/main/screenshot/create-reservation.png" alt="Creation d une reservation par l admin" width="900" />

Cette interface permet a l administrateur de creer une reservation manuellement. Il peut associer la reservation a un utilisateur existant en le recherchant par son adresse e-mail, puis selectionner le bien et les dates concernees.

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
