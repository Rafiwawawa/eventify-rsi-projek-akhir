@extends('layouts.app')

@section('title', 'Admin - Buat Event')

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER --}}
      <div class="flex items-center justify-between mb-8">
        <div>
          <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
            <a href="{{ route('admin.events') }}" class="hover:text-blue-600 transition">Manajemen Event</a>
            <span>/</span>
            <span class="text-slate-800 font-medium">Buat Baru</span>
          </div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buat Event Baru 🎉</h1>
        </div>
      </div>

      {{-- ERROR ALERT --}}
      @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-3">
          <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <div>
            <p class="font-bold text-sm">Harap perbaiki kesalahan berikut:</p>
            <ul class="list-disc ml-4 text-xs mt-1 space-y-1">
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 1. INFORMASI DASAR --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 mb-8">
          <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            Informasi Dasar
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Judul Event --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Judul Event</label>
              <input type="text" name="title"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900"
                placeholder="Contoh: Konser Musik 2025">
            </div>

            {{-- Kategori Dihapus --}}

            {{-- Kota --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Kota</label>
              <select name="city"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900 cursor-pointer">
                @foreach ($cities as $city)
                  <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
              </select>
            </div>

            {{-- Lokasi Detail --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Lokasi Lengkap (Venue)</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <input type="text" name="location"
                  class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900"
                  placeholder="Contoh: Stadion Gelora Bung Karno">
              </div>
            </div>

            {{-- Tanggal & Waktu --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Tanggal Event</label>
              <input type="date" name="event_date"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900">
            </div>
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Waktu Mulai</label>
              <input type="time" name="event_time"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900">
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Deskripsi Event</label>
              <textarea name="description" rows="4"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900"
                placeholder="Jelaskan detail acara..."></textarea>
            </div>

            {{-- Info Tambahan --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Informasi Tambahan (Opsional)</label>
              <textarea name="additional_info" rows="3"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900"
                placeholder="Contoh: Dresscode, Larangan, dll..."></textarea>
            </div>

            {{-- Upload Gambar --}}
            <div class="md:col-span-2">
              <label class="block text-sm font-bold text-slate-700 mb-1.5">Banner Event</label>
              <div class="flex items-center justify-center w-full">
                <label
                  class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition group">
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-2 text-slate-400 group-hover:text-blue-500 transition" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-sm text-slate-500">Klik untuk upload banner (JPG, PNG)</p>
                  </div>
                  <input type="file" name="image" class="hidden">
                </label>
              </div>
            </div>
          </div>
        </div>

        {{-- 2. MANAJEMEN TIKET --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 mb-8">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
              <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
              </div>
              Manajemen Tiket
            </h2>
            <button type="button" id="addTicketBtn"
              class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Tambah Tiket
            </button>
          </div>

          <div id="ticket-wrapper" class="space-y-4">
            {{-- TICKET ITEM 0 (DEFAULT) --}}
            <div class="ticket-item bg-slate-50 p-5 rounded-xl border border-slate-200 relative group">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                  <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jenis Tiket</label>
                  <input type="text" name="tickets[0][type]"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="e.g. VIP">
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Harga (Rp)</label>
                  <input type="number" name="tickets[0][price]"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="0">
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Stok</label>
                  <input type="number" name="tickets[0][stock]"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="100">
                </div>
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Benefit (Pisahkan dengan '|')</label>
                <input type="text" name="tickets[0][benefits]"
                  class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm"
                  placeholder="Free Drink|Front Row|Merchandise">
              </div>
            </div>
          </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-4">
          <a href="{{ route('admin.events') }}"
            class="px-6 py-3 rounded-xl border border-slate-300 text-slate-600 font-bold hover:bg-slate-50 transition">
            Batal
          </a>
          <button type="submit"
            class="px-8 py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all">
            Simpan Event
          </button>
        </div>

      </form>
    </div>
  </div>

  {{-- SCRIPT UNTUK TAMBAH TIKET --}}
  <script>
    let ticketIndex = 1;

    document.getElementById('addTicketBtn').addEventListener('click', () => {
      let wrapper = document.getElementById('ticket-wrapper');

      let html = `
          <div class="ticket-item bg-slate-50 p-5 rounded-xl border border-slate-200 relative group animate-fade-in-down">

              {{-- Tombol Hapus Tiket --}}
              <button type="button" onclick="this.closest('.ticket-item').remove()" class="absolute top-3 right-3 text-slate-400 hover:text-red-500 transition">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 pr-8">
                  <div>
                      <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jenis Tiket</label>
                      <input type="text" name="tickets[${ticketIndex}][type]" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="e.g. Regular">
                  </div>
                  <div>
                      <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Harga (Rp)</label>
                      <input type="number" name="tickets[${ticketIndex}][price]" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="0">
                  </div>
                  <div>
                      <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Stok</label>
                      <input type="number" name="tickets[${ticketIndex}][stock]" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="50">
                  </div>
              </div>
              <div>
                  <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Benefit (Pisahkan dengan '|')</label>
                  <input type="text" name="tickets[${ticketIndex}][benefits]" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm" placeholder="Entry Access">
              </div>
          </div>
      `;

      wrapper.insertAdjacentHTML("beforeend", html);
      ticketIndex++;
    });
  </script>

  <style>
    /* Animasi halus saat tambah tiket */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-down {
      animation: fadeInDown 0.3s ease-out;
    }
  </style>
@endsection