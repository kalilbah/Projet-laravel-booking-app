<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function destroy(Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        $booking->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'booking-cancelled');
    }
}
