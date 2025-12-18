@extends('layouts.app')

@section('title', 'Checkout Tiket')

@section('content')
  {{-- Background abu-abu tipis agar konsisten dengan page lain --}}
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

      {{-- Tombol Kembali (Opsional, untuk UX yang baik) --}}
      <a href="{{ route('events.detail', $event->slug)}}"
        class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition mb-6 group">
        <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Batal & Kembali
      </a>

      <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Checkout Tiket 🛒</h1>
        <p class="text-slate-500 mt-2">Selesaikan pembayaran untuk mengamankan tiketmu.</p>
      </div>

      <div class="grid gap-8">

        {{-- INFORMASI USER (CARD) --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
          {{-- Dekorasi header card --}}
          <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <div>
              <h2 class="font-bold text-lg text-slate-900">Informasi Pembeli</h2>
              <p class="text-xs text-slate-500">Tiket akan dikirim ke detail kontak di bawah ini.</p>
            </div>
          </div>

          <div class="space-y-4">
            {{-- Nama --}}
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
              </svg>
              <div>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Nama Lengkap</p>
                <p class="font-medium text-slate-900">{{ $user->nama_lengkap }}</p>
              </div>
            </div>

            {{-- Email --}}
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <div>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Alamat Email</p>
                <p class="font-medium text-slate-900">{{ $user->email }}</p>
              </div>
            </div>

            {{-- Telepon --}}
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <div>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Nomor Telepon</p>
                <p class="font-medium text-slate-900">{{ $user->nomor_telepon }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- INFO EVENT & FORM (CARD) --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100">

          {{-- Header Produk --}}
          <div class="mb-8 bg-slate-50 p-5 rounded-xl border border-slate-100">
            <h2 class="font-bold text-xl text-slate-900 mb-1">{{ $event->title }}</h2>
            <div class="flex items-center justify-between mt-2">
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-blue-100 text-blue-800">
                {{ $ticket->type }}
              </span>
              <span class="font-bold text-lg text-blue-600">
                Rp {{ number_format($ticket->price, 0, ',', '.') }} <span class="text-xs text-slate-400 font-normal">/
                  tiket</span>
              </span>
            </div>
          </div>

          {{-- FORM START --}}
          <form action="{{ route('pesan.proses') }}" method="POST">
            @csrf
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

            <div class="space-y-6">

              {{-- Input Jumlah --}}
              <div>
                <label class="block mb-2 text-sm font-bold text-slate-700 uppercase tracking-wide">Jumlah Tiket</label>
                <div class="relative">
                  {{--
                  PERUBAHAN DI INPUT:
                  1. max="{{ $ticket->stock }}" : Ini validasi bawaan HTML (Browser akan tahu batasnya).
                  2. class="peer ..." : Memberi tahu elemen bawahnya untuk 'mengawasi' input ini.
                  3. invalid:... : Style yang akan aktif otomatis kalau angkanya melebihi max.
                  --}}
                  <input type="number" name="quantity" min="1" max="{{ $ticket->stock }}" value="1" required class="peer block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-900 font-semibold 
                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all shadow-sm
                  invalid:border-red-500 invalid:text-red-600 invalid:focus:ring-red-500 invalid:focus:border-red-500"
                  placeholder="Masukkan jumlah tiket">

                  <div
                    class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400 text-sm font-medium">
                    Tiket
                  </div>
              </div>

                {{--
                PERUBAHAN DI PESAN ERROR:
                1. hidden : Defaultnya sembunyi.
                2. peer-invalid:flex : Kalau input di atas (peer) tidak valid/melebihi max, ubah jadi 'flex' (muncul).
                --}}
                <p
                  class="hidden peer-invalid:flex mt-2 text-xs font-semibold text-red-500 items-center gap-1 animate-pulse">
                  <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                  Maaf, jumlah melebihi sisa tiket (Maks: {{ $ticket->stock }})
                </p>
              </div>

              {{-- Input Metode Pembayaran --}}
              <div>
                <label class="block mb-2 text-sm font-bold text-slate-700 uppercase tracking-wide">Metode
                  Pembayaran</label>
                <div class="relative">
                  <select name="payment_method"
                    class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-white text-slate-900 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm cursor-pointer appearance-none">
                    <option value="QRIS">QRIS (Gopay, OVO, Dana)</option>
                    <option value="VA">Virtual Account Bank</option>
                    <option value="EWALLET">E-Wallet Lainnya</option>
                  </select>
                  {{-- Custom Arrow Icon --}}
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                  </div>
                </div>
                <p class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                  <svg class="w-3 h-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                  Transaksi dijamin aman dan terenkripsi.
                </p>
              </div>

              {{-- Button Submit --}}
              <div class="pt-4">
                <button
                  class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                  <span>Lanjutkan Pembayaran</span>
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </button>
              </div>

            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection