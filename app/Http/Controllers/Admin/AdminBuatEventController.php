<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBuatEventController extends Controller
{
    public function index()
    {
        // Hapus variabel categories

        $cities = [
            'Jakarta','Surabaya','Bandung','Medan','Bekasi','Tangerang','Depok','Semarang','Palembang',
            'Makassar','Bogor','Batam','Padang','Denpasar','Malang','Yogyakarta','Solo','Balikpapan',
            'Banjarmasin','Pontianak','Manado','Pekanbaru','Samarinda'
        ];

        // Hapus categories dari compact
        return view('admin.events.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            // Hapus validasi category_id
            'description'   => 'required',
            'city'          => 'required',
            'location'      => 'required',
            'event_date'    => 'required',
            'event_time'    => 'required',
            'image'         => 'nullable|image|max:2048',

            'tickets.*.type'    => 'required',
            'tickets.*.price'   => 'required|integer',
            'tickets.*.stock'   => 'required|integer',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('events', 'public')
            : 'default.jpg';

        $event = Event::create([
            'title'          => $request->title,
            'slug'           => Str::slug($request->title) . '-' . time(),
            'description'    => $request->description,
            'additional_info'=> $request->additional_info,
            // Hapus category_id dari create
            'city'           => $request->city,
            'location'       => $request->location,
            'event_date'     => $request->event_date,
            'event_time'     => $request->event_time,
            'starting_price' => $request->tickets[0]['price'],
            'image'          => $imagePath,
            'status'         => 'open',
        ]);

        foreach ($request->tickets as $t) {
            Ticket::create([
                'event_id' => $event->id,
                'type'     => $t['type'],
                'price'    => $t['price'],
                'stock'    => $t['stock'],
                'benefits' => $t['benefits'] ?? '',
            ]);
        }

        return redirect()->route('admin.events')->with('success', 'Event berhasil dibuat!');
    }
}