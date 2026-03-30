<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter une photo de profil aux utilisateurs.
 *
 * Cette migration modifie la table "users" en ajoutant une nouvelle colonne
 * permettant de stocker le chemin (path) de la photo de profil.
 */
return new class extends Migration
{
    /**
     * Exécute la migration.
     *
     * Cette méthode est appelée lorsque tu lances :
     * php artisan migrate
     *
     * Elle ajoute une colonne "profile_photo_path" dans la table "users".
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajoute une colonne string nullable pour stocker le chemin de la photo
            // "nullable()" : la photo n'est pas obligatoire
            // "after('role')" : la colonne sera placée après la colonne "role"
            $table->string('profile_photo_path')->nullable()->after('role');
        });
    }

    /**
     * Annule la migration.
     *
     * Cette méthode est appelée lorsque tu fais :
     * php artisan migrate:rollback
     *
     * Elle supprime la colonne "profile_photo_path".
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprime la colonne ajoutée précédemment
            $table->dropColumn('profile_photo_path');
        });
    }
};
