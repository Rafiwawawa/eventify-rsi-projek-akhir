<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanTiketController extends Controller
{
    // STEP 1: Halaman Checkout
    public function checkout(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $event = $ticket->event;
        $user = Auth::user();

        return view('pesan.checkout', compact('ticket', 'event', 'user'));
    }


    // STEP 2: Proses Pesanan (buat order baru)
    public function proses(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required'
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // Cek stok
        if ($ticket->stock < $request->quantity) {
            return back()->with('error', 'Stok tiket tidak mencukupi!');
        }

        $total = $ticket->price * $request->quantity;

        // Kurangi stok
        $ticket->stock -= $request->quantity;
        $ticket->save();

        // Buat order
        $order = Order::create([
            'user_id' => Auth::id(),
            'event_id' => $ticket->event_id,
            'ticket_id' => $ticket->id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'payment_status' => 'pending',
        ]);

        // ke halaman pembayaran
        return redirect()->route('pembayaran.halaman', $order->id)
            ->with('payment_method', $request->payment_method);
    }
}
