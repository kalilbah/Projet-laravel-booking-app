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
        $properties = [
            [
                'name' => 'Loft lumineux a Lyon',
                'description' => 'Un loft spacieux et lumineux, ideal pour un sejour en centre-ville, a deux pas des commerces, des restaurants et des transports.',
            ],
            [
                'name' => 'Villa panoramique a Nice',
                'description' => 'Une villa elegante avec vue degagee sur les hauteurs de Nice, parfaite pour se detendre en famille ou entre amis dans un cadre calme.',
            ],
            [
                'name' => 'Studio elegant a Paris',
                'description' => 'Un studio confortable et soigneusement amenage, ideal pour decouvrir Paris le temps d un week-end ou d un court sejour professionnel.',
            ],
            [
                'name' => 'Maison de charme a Bordeaux',
                'description' => 'Une maison chaleureuse au style authentique, situee dans un quartier agreable pour profiter pleinement de l ambiance bordelaise.',
            ],
            [
                'name' => 'Appartement design a Lille',
                'description' => 'Un appartement moderne et bien equipe, pense pour offrir confort et praticite lors d un passage a Lille.',
            ],
            [
                'name' => 'Chalet familial a Annecy',
                'description' => 'Un chalet accueillant avec une atmosphere conviviale, parfait pour un sejour au calme pres du lac et des montagnes.',
            ],
        ];

        $property = fake()->randomElement($properties);

        return [
            'name' => $property['name'],
            'description' => $property['description'],
            'price_per_night' => fake()->randomFloat(2, 80, 320),
        ];
    }
}
