<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creation du compte administrateur utilisé pour acceder au panneau Filament.
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Creation d'un compte client de demonstration pour tester le parcours utilisateur.
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Géneration du catalogue de biens affichés sur le site.
        $properties = Property::factory()->count(6)->create();

        // Quelques reservations sont associées au compte de demonstration pour peupler l'interface.
        $properties->take(3)->each(function (Property $property) use ($user): void {
            Booking::factory()->create([
                'user_id' => $user->id,
                'property_id' => $property->id,
            ]);
        });
    }
}
