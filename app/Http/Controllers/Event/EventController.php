<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Ambil event terbaru yang statusnya open
        $events = Event::where('status', 'open')
            ->latest()
            ->get();

        // Daftar Kota Tetap Ada
        $kotaList = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Depok',
            'Makassar', 'Semarang', 'Bali', 'Batam', 'Yogyakarta'
        ];

        // Default filter kota (jika nanti mau dipakai)
        $selectedCities = [];

        // Hapus variable categories dan selectedCategory dari compact
        return view('event.index', compact(
            'events',
            'kotaList',
            'selectedCities'
        ));
    }
}