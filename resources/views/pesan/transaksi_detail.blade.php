@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Detail Transaksi</h1>

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="font-semibold text-lg">{{ $order->event->title }}</h2>

        <p class="text-slate-600">Jenis tiket: {{ $order->ticket->type }}</p>
        <p class="text-slate-600">Jumlah: {{ $order->quantity }}</p>
        <p class="text-slate-600 mb-4">
            Total: Rp {{ number_format($order->total_price,0,',','.') }}
        </p>

        <a href="{{ route('tiket.saya.detail', $order->id) }}"
           class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">
            Lihat Tiket
        </a>

    </div>

</div>
@endsection
