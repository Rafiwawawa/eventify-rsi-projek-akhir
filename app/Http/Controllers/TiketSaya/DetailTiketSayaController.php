<?php

namespace App\Http\Controllers\TiketSaya;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DetailTiketSayaController extends Controller
{
    public function show($order_id)
    {
        $order = Order::with(['event', 'ticket'])
            ->where('id', $order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('TiketSaya.detail', compact('order'));
    }
}
