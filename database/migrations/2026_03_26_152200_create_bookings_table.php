<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crée la table bookings.
 * Un booking relie un user à une property sur une période donnée.
 * Suppression en cascade si le user ou la property est supprimé.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // L'utilisateur qui réserve (via Laravel Breeze)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Le bien réservé
            $table->foreignId('property_id')->constrained()->onDelete('cascade');

            // Période de réservation — à valider côté appli (end_date >= start_date)
            $table->date('start_date');
            $table->date('end_date');

            $table->timestamps();
        });
    }

    // Rollback : supprime la table
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
