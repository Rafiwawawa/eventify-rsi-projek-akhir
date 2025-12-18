<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class CariEventController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        $events = Event::where('title', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%")
            ->orWhere('city', 'like', "%$search%")
            ->get();

        $categories = Category::all();

        $kotaList = [
            'Jakarta','Surabaya','Bandung','Medan','Depok','Makassar',
            'Semarang','Bali','Batam','Yogyakarta'
        ];

        return view('event.index', [
            'events' => $events,
            'categories' => $categories,
            'kotaList' => $kotaList,
            'search' => $search,
            'selectedCategory' => null,
            'selectedCities' => []
        ]);
    }
}
