<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crée la table properties.
 * Représente un bien disponible à la location.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        // Nom du bien
            $table->text('description');                   // Description détaillée
            $table->decimal('price_per_night', 8, 2);     // Prix/nuit (ex: 999999.99 max)
            $table->timestamps();
        });
    }

    // Rollback : supprime la table
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
