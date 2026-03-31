<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $userId = Auth::id();

        abort_unless($userId !== null, 403);

        // On recharge l utilisateur courant pour afficher uniquement ses reservations dans l espace membre.
        $user = User::query()->findOrFail($userId);

        return view('dashboard', [
            'userBookings' => $user->bookings()->with('property')->latest('start_date')->get(),
        ]);
    }
}
