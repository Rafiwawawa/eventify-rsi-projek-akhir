@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
  <div class="bg-slate-50 min-h-screen py-12 flex items-center justify-center">

    {{-- Menggunakan max-w-lg agar kartu pembayaran terlihat compact dan fokus --}}
    <div class="max-w-lg w-full px-4 sm:px-6">

      {{-- Header Status --}}
      <div class="text-center mb-8">
        <div
          class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4 animate-pulse">
          <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-900">Menunggu Pembayaran</h1>
        <p class="text-slate-500 mt-2">Selesaikan pembayaran Anda sebelum waktu habis.</p>
      </div>

      {{-- KARTU PEMBAYARAN UTAMA --}}
      <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

        {{-- Bagian Atas: Total & Metode --}}
        <div class="p-8 text-center border-b border-slate-100 border-dashed">
          <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Tagihan</p>
          <div class="text-4xl font-extrabold text-slate-900 mb-6">
            Rp {{ number_format($order->total_price, 0, ',', '.') }}
          </div>

          <div class="inline-block bg-slate-50 rounded-xl border border-slate-200 px-4 py-2">
            <p class="text-sm text-slate-600 flex items-center justify-center gap-2">
              Metode Pembayaran:
              <span class="font-bold text-blue-700 uppercase">{{ $paymentMethod }}</span>
            </p>
          </div>
        </div>

        {{-- Bagian Tengah: Instruksi Simulasi --}}
        <div class="p-8 bg-slate-50/50">

          {{-- Alert Simulasi (Pengganti teks biasa) --}}
          <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-start gap-3 mb-6">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
              <h3 class="font-bold text-yellow-800 text-sm">Mode Simulasi</h3>
              <p class="text-yellow-700 text-xs mt-1 leading-relaxed">
                Ini adalah simulasi pembayaran (Dummy Payment). Anda tidak perlu mentransfer uang sungguhan. Cukup klik
                tombol di bawah untuk menyelesaikan pesanan.
              </p>
            </div>
          </div>

          {{-- FORM BUTTON --}}
          <form action="{{ route('pembayaran.selesai', $order->id) }}" method="POST">
            @csrf
            <button
              class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-600/20 hover:shadow-green-600/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Simulasikan Pembayaran Selesai
            </button>
          </form>

          <div class="mt-6 text-center">
            <p class="text-xs text-slate-400 flex items-center justify-center gap-1.5">
              <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              Enkripsi End-to-End Aman 256-bit
            </p>
          </div>
        </div>

      </div>

      {{-- Footer Link --}}
      <div class="text-center mt-8">
        <a href="{{ url()->previous() }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">
          &larr; Batalkan Pembayaran
        </a>
      </div>

    </div>
  </div>
@endsection