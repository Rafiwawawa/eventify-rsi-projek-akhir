<?php

namespace App\Http\Controllers\TiketSaya;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TiketSayaController extends Controller
{
    public function index()
    {
        $orders = Order::with(['event', 'ticket'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('TiketSaya.index', compact('orders'));
    }
}
