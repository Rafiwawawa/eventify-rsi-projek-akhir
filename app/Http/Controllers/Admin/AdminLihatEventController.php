<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminLihatEventController extends Controller
{
    public function index()
    {
        // Hapus with('category')
        $events = Event::orderBy('created_at', 'desc')
            ->get();

        return view('admin.events.index', compact('events'));
    }
}