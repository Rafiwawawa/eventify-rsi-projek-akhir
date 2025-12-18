@extends('layouts.app')

@section('title', 'Rekap Penjualan - ' . $event->title)

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER & NAVIGASI --}}
      <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
          <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
            <a href="{{ route('admin.events') }}" class="hover:text-blue-600 transition">Manajemen Event</a>
            <span>/</span>
            <span class="text-slate-800 font-medium">Laporan</span>
          </div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Rekap Penjualan 📊</h1>
        </div>

        {{-- Tombol Aksi (Print) --}}
        <button onclick="window.print()"
          class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl font-semibold hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
          </svg>
          Cetak Laporan
        </button>
      </div>

      {{-- 1. KARTU DETAIL EVENT --}}
      <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
        <div class="flex items-start justify-between mb-4">
          <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Informasi Event
          </h2>
          
          {{-- KATEGORI DIHAPUS, DIGANTI STATUS --}}
          @if($event->status == 'open')
            <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full uppercase tracking-wide border border-green-100">
              Open
            </span>
          @else
            <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full uppercase tracking-wide border border-slate-200">
              Closed
            </span>
          @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Nama Event</p>
            <p class="font-semibold text-slate-900 text-lg">{{ $event->title }}</p>
          </div>
          <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Lokasi</p>
            <p class="font-medium text-slate-700 flex items-center gap-1">
              <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              {{ $event->city }}
            </p>
          </div>
          <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tanggal</p>
            <p class="font-medium text-slate-700 flex items-center gap-1">
              <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              {{ date('d M Y', strtotime($event->event_date)) }}
            </p>
          </div>
          <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Waktu</p>
            <p class="font-medium text-slate-700 flex items-center gap-1">
              <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              {{ date('H:i', strtotime($event->event_time)) }} WIB
            </p>
          </div>
        </div>
      </div>

      {{-- 2. STATS CARDS (GRID) --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Total Tiket --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
          </div>
          <div>
            <p class="text-slate-500 text-sm font-medium">Total Tiket Terjual</p>
            <h3 class="text-2xl font-extrabold text-slate-900">{{ $event->orders->sum('quantity') }} <span
                class="text-sm font-normal text-slate-400">pcs</span></h3>
          </div>
        </div>

        {{-- Total Pendapatan --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div>
            <p class="text-slate-500 text-sm font-medium">Total Pendapatan</p>
            <h3 class="text-2xl font-extrabold text-slate-900">Rp
              {{ number_format($event->orders->sum('total_price'), 0, ',', '.') }}</h3>
          </div>
        </div>

        {{-- Total Peserta --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <div>
            <p class="text-slate-500 text-sm font-medium">Total Peserta</p>
            <h3 class="text-2xl font-extrabold text-slate-900">{{ $event->orders->count() }} <span
                class="text-sm font-normal text-slate-400">orang</span></h3>
          </div>
        </div>

      </div>

      {{-- 3. TABEL TRANSAKSI --}}
      <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
          <h2 class="text-lg font-bold text-slate-800">Riwayat Transaksi</h2>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-100">
                <th class="px-6 py-4 font-semibold">Nama Pembeli</th>
                <th class="px-6 py-4 font-semibold">Jenis Tiket</th>
                <th class="px-6 py-4 font-semibold text-center">Jumlah</th>
                <th class="px-6 py-4 font-semibold text-right">Total Harga</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse ($event->orders as $order)
                <tr class="hover:bg-slate-50/80 transition">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div
                        class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                        {{ substr($order->user->nama_lengkap, 0, 1) }}
                      </div>
                      <span class="font-medium text-slate-900">{{ $order->user->nama_lengkap }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      class="inline-block px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                      {{ $order->ticket->type }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-center text-slate-600">
                    {{ $order->quantity }}
                  </td>
                  <td class="px-6 py-4 text-right font-bold text-green-600">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center text-slate-400">
                      <svg class="w-12 h-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                      </svg>
                      <p class="text-sm font-medium">Belum ada data penjualan.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
@endsection