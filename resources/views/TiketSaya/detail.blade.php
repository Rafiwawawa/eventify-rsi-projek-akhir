@extends('layouts.app')

@section('title', 'Detail Tiket')

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

      {{-- Navigasi Kembali --}}
      <div class="mb-6">
        <a href="{{ route('tiket.saya') }}"
          class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition group">
          <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Kembali ke Tiket Saya
        </a>
      </div>

      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-900">E-Ticket Anda 🎫</h1>
        <button onclick="window.print()"
          class="hidden md:flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
          </svg>
          Simpan / Cetak
        </button>
      </div>

      {{-- CARD TIKET --}}
      <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">

        {{-- HEADER: INFO EVENT --}}
        <div class="bg-slate-900 p-6 md:p-8 text-white relative overflow-hidden">
          {{-- Dekorasi Background --}}
          <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>

          <h2 class="text-2xl md:text-3xl font-bold mb-4 relative z-10">{{ $order->event->title }}</h2>

          <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8 text-slate-300 text-sm relative z-10">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>{{ $order->event->location }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span>{{ date('l, d M Y', strtotime($order->event->event_date)) }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>{{ date('H:i', strtotime($order->event->event_time)) }} WIB</span>
            </div>
          </div>
        </div>

        {{-- BODY: DETAIL TIKET & QR --}}
        <div class="flex flex-col md:flex-row">

          {{-- Bagian Kiri: Rincian --}}
          <div class="flex-grow p-6 md:p-8">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Rincian Pesanan</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <div>
                <p class="text-xs text-slate-500 mb-1">Jenis Tiket</p>
                <p class="font-bold text-lg text-slate-900">{{ $order->ticket->type }}</p>
              </div>
              <div>
                <p class="text-xs text-slate-500 mb-1">Jumlah</p>
                <p class="font-bold text-lg text-slate-900">{{ $order->quantity }} Pax</p>
              </div>
              <div class="md:col-span-2">
                <p class="text-xs text-slate-500 mb-1">Total Pembayaran</p>
                <p class="font-bold text-xl text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
              </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
              <p class="text-sm font-bold text-slate-700 mb-3">Benefit Termasuk:</p>
              <ul class="space-y-2">
                @foreach (explode('|', $order->ticket->benefits) as $b)
                  <li class="flex items-start gap-2 text-sm text-slate-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ trim($b) }}
                  </li>
                @endforeach
              </ul>
            </div>
          </div>

          {{-- Garis Putus-putus (Divider) --}}
          <div class="relative md:w-0 border-b md:border-b-0 md:border-r-2 border-dashed border-slate-200">
            {{-- Bulatan Dekorasi (Efek Sobekan Tiket) --}}
            <div class="absolute -left-3 -top-3 md:-top-3 md:-left-3 w-6 h-6 bg-slate-50 rounded-full z-10"></div>
            <div
              class="absolute -right-3 -top-3 md:bottom-auto md:top-auto md:-bottom-3 md:-left-3 w-6 h-6 bg-slate-50 rounded-full z-10">
            </div>
          </div>

          {{-- Bagian Kanan: QR Code --}}
          <div
            class="w-full md:w-64 bg-slate-50 p-6 md:p-8 flex flex-col items-center justify-center text-center border-l-0 md:border-l border-dashed border-slate-200">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Scan Masuk</p>

            {{-- QR Code Placeholder (Menggunakan API Google Chart untuk demo visual, atau ganti gambar statis) --}}
            <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-200 mb-3">
              <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $order->id }}-{{ $order->event->slug }}"
                alt="QR Code Tiket" class="w-32 h-32 object-contain">
            </div>

            <p class="text-[10px] text-slate-400 font-mono">ID: #ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            <span class="mt-3 inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
              LUNAS
            </span>
          </div>
        </div>

      </div>

      {{-- INFO PENTING --}}
      <div class="mt-8 flex items-start gap-4 p-5 bg-blue-50 rounded-2xl border border-blue-100">
        <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
          <h4 class="font-bold text-blue-900 text-sm mb-1">Informasi Penting</h4>
          <p class="text-sm text-blue-800/80 leading-relaxed">
            Mohon simpan tiket ini. Tunjukkan QR Code di atas kepada petugas di lokasi acara untuk proses check-in. Jangan
            bagikan QR Code ini kepada orang lain.
          </p>
        </div>
      </div>

    </div>
  </div>
@endsection