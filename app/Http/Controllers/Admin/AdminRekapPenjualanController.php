<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminRekapPenjualanController extends Controller
{
    public function index($id)
    {
        $event = Event::with(['tickets', 'orders.user'])->findOrFail($id);

        return view('admin.events.rekap', compact('event'));
    }
}
