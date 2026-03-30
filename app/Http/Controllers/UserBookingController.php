<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;

class UserBookingController extends Controller
{
    public function destroy(Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === auth()->id(), 403);

        $booking->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'booking-cancelled');
    }
}
