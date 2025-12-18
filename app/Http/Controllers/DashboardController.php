<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Event Populer
        $popularEvents = Event::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(4)
            ->get();

        // Event Pilihan - ambil 4 saja
        $selectedEvents = Event::inRandomOrder()->take(4)->get();

        // Event di Kotamu - ambil 4 saja
        $cityEvents = [];

        if (Auth::check()) {
            $userCity = Auth::user()->kota;
            $mainCity = explode(" ", trim($userCity))[0];

            $cityEvents = Event::where('city', 'LIKE', "%$mainCity%")
                ->orderBy('event_date', 'asc')
                ->take(4)
                ->get();
        }

        return view('dashboard', compact(
            'popularEvents',
            'selectedEvents',
            'cityEvents'
        ));
    }

}
