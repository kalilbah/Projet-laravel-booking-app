<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        // Jeu de données fixe pour générer des biens avec un nom et une description.
        $properties = [
            [
                'name' => 'Loft lumineux à Lyon',
                'description' => 'Un loft spacieux et lumineux, idéal pour un séjour en centre-ville, à deux pas des commerces, des restaurants et des transports.',
            ],
            [
                'name' => 'Villa panoramique à Nice',
                'description' => 'Une villa élégante avec vue dégagée sur les hauteurs de Nice, parfaite pour se détendre en famille ou entre amis dans un cadre calme.',
            ],
            [
                'name' => 'Studio élégant à Paris',
                'description' => 'Un studio confortable et soigneusement aménagé, idéal pour découvrir Paris le temps d\'un week-end ou d\'un court séjour professionnel.',
            ],
            [
                'name' => 'Maison de charme à Bordeaux',
                'description' => 'Une maison chaleureuse au style authentique, située dans un quartier agréable pour profiter pleinement de l\'ambiance bordelaise.',
            ],
            [
                'name' => 'Appartement design à Lille',
                'description' => 'Un appartement moderne et bien équipé, pensé pour offrir confort et praticité lors d\'un passage à Lille.',
            ],
            [
                'name' => 'Chalet familial à Annecy',
                'description' => 'Un chalet accueillant avec une atmosphère conviviale, parfait pour un séjour au calme près du lac et des montagnes.',
            ],
        ];

        // Sélection aléatoire d'un bien pour alimenter les données de démonstration.
        $property = fake()->randomElement($properties);

        return [
            'name' => $property['name'],
            'description' => $property['description'],
            'price_per_night' => fake()->randomFloat(2, 80, 320),
        ];
    }
}
