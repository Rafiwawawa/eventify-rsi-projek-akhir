<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class FilterEventController extends Controller
{
    public function filter(Request $request)
    {
        $search = $request->search;
        $selectedCities = $request->cities ?? [];

        $events = Event::query()
            ->when($search, function($q) use ($search) {
                // Penting: Bungkus logic OR dalam function agar tidak bentrok dengan filter kota
                $q->where(function($subquery) use ($search) {
                    $subquery->where('title', 'like', "%$search%")
                             ->orWhere('location', 'like', "%$search%")
                             ->orWhere('city', 'like', "%$search%");
                });
            })
            ->when($selectedCities, fn($q) =>
                $q->whereIn('city', $selectedCities)
            )
            ->latest() // Opsional: Biar event terbaru muncul duluan
            ->get();

        // List kota manual
        $kotaList = [
            'Jakarta','Surabaya','Bandung','Medan','Bekasi','Tangerang','Depok','Semarang','Palembang',
            'Makassar','Bogor','Batam','Padang','Denpasar','Malang','Yogyakarta','Solo','Balikpapan',
            'Banjarmasin','Pontianak','Manado','Pekanbaru','Samarinda'
        ];

        return view('event.index', compact(
            'events',
            'kotaList',
            'search',
            'selectedCities'
        ));
    }
}