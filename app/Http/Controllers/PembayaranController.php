<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // STEP 3: Halaman Pembayaran
    public function halamanPembayaran($order_id)
    {
        $order = Order::with(['event', 'ticket'])->findOrFail($order_id);

        $paymentMethod = session('payment_method', 'QRIS');

        return view('pesan.pembayaran', compact('order', 'paymentMethod'));
    }

    // STEP 4: Selesaikan Pembayaran
    public function selesai(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        $order->update([
            'payment_status' => 'paid'
        ]);

        return redirect()->route('transaksi.detail', $order_id);
    }

    // STEP 5: Detail Transaksi
    public function detailTransaksi($order_id)
    {
        $order = Order::with(['event', 'ticket'])->findOrFail($order_id);

        return view('pesan.transaksi_detail', compact('order'));
    }
}
