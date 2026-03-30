<?php

namespace Tests\Feature;

use App\Livewire\BookingManager;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BookingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_properties_index_is_available(): void
    {
        $property = Property::factory()->create([
            'name' => 'Maison temoin',
        ]);

        $response = $this->get(route('properties.index'));

        $response->assertOk();
        $response->assertSee($property->name);
    }

    public function test_authenticated_user_can_create_a_booking_from_livewire_component(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create([
            'price_per_night' => 120,
        ]);

        $this->actingAs($user);

        Livewire::test(BookingManager::class, ['property' => $property])
            ->set('start_date', now()->addDays(5)->toDateString())
            ->set('end_date', now()->addDays(8)->toDateString())
            ->call('save')
            ->assertDispatched('booking-created')
            ->assertSet('successMessage', 'Réservation enregistrée avec succès.');

        $this->assertDatabaseHas(Booking::class, [
            'user_id' => $user->id,
            'property_id' => $property->id,
        ]);
    }

    public function test_overlapping_booking_is_rejected(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();

        Booking::factory()->create([
            'property_id' => $property->id,
            'start_date' => now()->addDays(10)->toDateString(),
            'end_date' => now()->addDays(14)->toDateString(),
        ]);

        $this->actingAs($user);

        Livewire::test(BookingManager::class, ['property' => $property])
            ->set('start_date', now()->addDays(11)->toDateString())
            ->set('end_date', now()->addDays(12)->toDateString())
            ->call('save')
            ->assertHasErrors(['start_date']);

        $this->assertDatabaseCount('bookings', 1);
    }
}
