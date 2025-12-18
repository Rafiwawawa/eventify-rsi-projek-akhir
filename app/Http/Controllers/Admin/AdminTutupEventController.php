<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminTutupEventController extends Controller
{
    public function tutup($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'closed';
        $event->save();

        return back()->with('success', 'Event berhasil ditutup!');
    }
}
