<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BookingManager extends Component
{
    public Property $property;

    public string $start_date = '';

    public string $end_date = '';

    public ?string $successMessage = null;

    public function mount(Property $property): void
    {
        $this->property = $property;
    }

    public function save(): void
    {
        if (! Auth::check()) {
            $this->redirectRoute('login', navigate: true);

            return;
        }

        $user = Auth::user();

        if (! $user instanceof User) {
            $this->redirectRoute('login', navigate: true);

            return;
        }

        // Bloque l'usage du module de réservation pour un compte administrateur.
        if ($user->isAdmin()) {
            $this->redirect('/admin', navigate: true);

            return;
        }

        $validated = $this->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        if (! $this->property->isAvailableBetween($start->toDateString(), $end->toDateString())) {
            throw ValidationException::withMessages([
                'start_date' => 'Cette période est déjà réservée pour ce logement.',
            ]);
        }

        Booking::query()->create([
            'user_id' => Auth::id(),
            'property_id' => $this->property->id,
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
        ]);

        $this->reset(['start_date', 'end_date']);
        // Message affiché dans l'interface après une réservation enregistrée.
        $this->successMessage = 'Réservation enregistrée avec succès.';

        $this->dispatch('booking-created');
    }

    public function getTotalNightsProperty(): int
    {
        if (! $this->start_date || ! $this->end_date) {
            return 0;
        }

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        return max($start->diffInDays($end), 1);
    }

    public function getEstimatedTotalProperty(): string
    {
        return number_format($this->totalNights * (float) $this->property->price_per_night, 2, ',', ' ');
    }

    public function clearDates(): void
    {
        $this->reset(['start_date', 'end_date']);
    }

    public function render()
    {
        return view('livewire.booking-manager', [
            'recentBookings' => $this->property->bookings()
                ->with('user')
                ->latest('start_date')
                ->take(5)
                ->get(),
        ]);
    }
}
