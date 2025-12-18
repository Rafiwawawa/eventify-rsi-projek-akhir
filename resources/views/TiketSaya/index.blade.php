@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

      {{-- Header Page --}}
      <div class="flex items-center justify-between mb-8">
        <div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tiket Saya 🎫</h1>
          <p class="text-slate-500 mt-2">Riwayat pembelian dan tiket aktif Anda.</p>
        </div>
        {{-- Tombol Cari Event (Opsional) --}}
        <a href="{{ route('events') }}"
          class="hidden md:flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition shadow-sm">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          Cari Event Lain
        </a>
      </div>

      {{-- LIST TIKET --}}
      <div class="space-y-4">
        @forelse ($orders as $order)
          <a href="{{ route('tiket.saya.detail', $order->id) }}"
            class="group flex flex-col md:flex-row bg-white rounded-2xl shadow-sm hover:shadow-lg border border-slate-100 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">

            {{-- 1. Gambar Event (Thumbnail) --}}
            <div class="relative w-full md:w-48 h-48 md:h-auto flex-shrink-0">
              <img
                src="{{ str_starts_with($order->event->image, 'http') ? $order->event->image : asset('storage/' . $order->event->image) }}"
                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">

              {{-- Overlay Gelap di Mobile agar text terbaca --}}
              <div class="absolute inset-0 bg-black/10 md:bg-transparent"></div>
            </div>

            {{-- 2. Konten Utama --}}
            <div class="flex-grow p-5 md:p-6 flex flex-col justify-center">
              {{-- Tanggal Event --}}
              <div class="flex items-center gap-2 mb-2 text-xs font-bold uppercase tracking-wider text-blue-600">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ date('d M Y', strtotime($order->event->event_date)) }}
              </div>

              {{-- Judul Event --}}
              <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                {{ $order->event->title }}
              </h2>

              {{-- Lokasi & Waktu --}}
              <div class="flex items-center gap-4 text-sm text-slate-500">
                <div class="flex items-center gap-1">
                  <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span class="line-clamp-1">{{ $order->event->location }}</span>
                </div>
              </div>
            </div>

            {{-- 3. Info Tiket & Harga (Bagian Kanan) --}}
            <div
              class="p-5 md:p-6 border-t md:border-t-0 md:border-l border-slate-50 bg-slate-50/50 flex flex-row md:flex-col justify-between items-center md:items-end min-w-[180px]">

              <div class="text-left md:text-right">
                <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700 mb-1">
                  {{ $order->ticket->type }}
                </span>
                <div class="text-xs text-slate-500 font-medium mt-1">
                  {{ $order->quantity }} Tiket x Rp {{ number_format($order->ticket->price, 0, ',', '.') }}
                </div>
              </div>

              <div class="text-right mt-0 md:mt-4">
                <p class="text-sm text-slate-400 font-medium mb-1 text-right">Total Bayar</p>
                <p class="text-lg font-bold text-slate-900">
                  Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </p>

                {{-- Badge Status --}}
                <div class="mt-2 flex justify-end">
                  <span
                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    LUNAS
                  </span>
                </div>
              </div>
            </div>

          </a>
        @empty
          {{-- EMPTY STATE (Jika belum ada tiket) --}}
          <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-slate-200">
            <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
              </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum ada tiket</h3>
            <p class="text-slate-500 mt-1 max-w-sm mx-auto">Anda belum pernah melakukan pembelian tiket event apapun.</p>

            <a href="{{ route('events.index') }}"
              class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition shadow-lg shadow-blue-600/30">
              Mulai Jelajahi Event
            </a>
          </div>
        @endforelse
      </div>

    </div>
  </div>
@endsection