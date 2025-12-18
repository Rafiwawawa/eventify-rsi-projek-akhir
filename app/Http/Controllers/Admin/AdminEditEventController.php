<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEditEventController extends Controller
{
    public function index($id)
    {
        $event = Event::with('tickets')->findOrFail($id);

        // Hapus variabel categories
        
        $cities = [
            'Jakarta','Surabaya','Bandung','Medan','Depok',
            'Makassar','Semarang','Bali','Batam','Yogyakarta'
        ];

        // Hapus categories dari compact
        return view('admin.events.edit', compact('event', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required',
            // Hapus validasi category_id
            'description' => 'required',
            'city'        => 'required',
            'location'    => 'required',
            'event_date'  => 'required',
            'event_time'  => 'required',
            'image'       => 'nullable|image|max:2048',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title'           => $request->title,
            // Hapus category_id dari update
            'description'     => $request->description,
            'additional_info' => $request->additional_info,
            'city'            => $request->city,
            'location'        => $request->location,
            'event_date'      => $request->event_date,
            'event_time'      => $request->event_time,
        ]);

        return redirect()->route('admin.events')->with('success', 'Event berhasil diupdate!');
    }
}