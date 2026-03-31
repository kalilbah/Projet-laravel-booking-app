<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class PropertyController extends Controller
{
    public function index(): View
    {
        $properties = Schema::hasTable('properties')
            ? Property::query()
            ->withCount('bookings')
            ->latest()
            ->paginate(6)
            : new LengthAwarePaginator([], 0, 6);

        return view('welcome', [
            'properties' => $properties,
        ]);
    }

    public function show(Property $property): View
    {
        return view('properties.show', [
            'property' => $property->load([
                'bookings' => fn($query) => $query->with('user')->latest('start_date')->take(5),
            ]),
        ]);
    }
}
