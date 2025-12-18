<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventDetailController extends Controller
{
    public function show($slug)
    {
        // Ambil event + tiket
        $event = Event::where('slug', $slug)
            ->where('status', 'open')
            ->with('tickets')
            ->firstOrFail();

        return view('event.detail', compact('event'));
    }
}
