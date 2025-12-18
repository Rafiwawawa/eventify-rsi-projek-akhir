@extends('layouts.app')

@section('title', 'Admin - Edit Event')

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER & BREADCRUMB --}}
      <div class="flex items-center justify-between mb-8">
        <div>
          <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
            <a href="{{ route('admin.events') }}" class="hover:text-blue-600 transition">Manajemen Event</a>
            <span>/</span>
            <span class="text-slate-800 font-medium">Edit Event</span>
          </div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Event ✏️</h1>
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
            <p class="font-bold text-sm">Gagal menyimpan perubahan:</p>
            <ul class="list-disc ml-4 text-xs mt-1 space-y-1">
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          {{-- KOLOM KIRI: FORM UTAMA --}}
          <div class="lg:col-span-2 space-y-8">

            {{-- 1. INFORMASI DASAR --}}
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
                Detail Event
              </h2>

              <div class="space-y-5">
                {{-- Judul --}}
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-1.5">Judul Event</label>
                  <input type="text" name="title" value="{{ $event->title }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-slate-900">
                </div>

                {{-- Kota (Sekarang full width karena kategori dihapus) --}}
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-1.5">Kota</label>
                  <select name="city"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    @foreach ($cities as $city)
                      <option value="{{ $city }}" {{ $event->city == $city ? 'selected' : '' }}>
                        {{ $city }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- Lokasi --}}
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-1.5">Lokasi Lengkap</label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                    </div>
                    <input type="text" name="location" value="{{ $event->location }}"
                      class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 transition text-slate-900">
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                  {{-- Tanggal --}}
                  <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Tanggal</label>
                    <input type="date" name="event_date" value="{{ $event->event_date }}"
                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 transition text-slate-900">
                  </div>
                  {{-- Waktu --}}
                  <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Waktu</label>
                    <input type="time" name="event_time" value="{{ $event->event_time }}"
                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 transition text-slate-900">
                  </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-1.5">Deskripsi</label>
                  <textarea name="description" rows="4"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 transition text-slate-900">{{ $event->description }}</textarea>
                </div>

                {{-- Info Tambahan --}}
                <div>
                  <label class="block text-sm font-bold text-slate-700 mb-1.5">Informasi Tambahan</label>
                  <textarea name="additional_info" rows="3"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 transition text-slate-900">{{ $event->additional_info }}</textarea>
                </div>
              </div>
            </div>

            {{-- 2. SECTION TIKET --}}
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                  </svg>
                </div>
                Daftar Tiket
              </h2>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($event->tickets as $t)
                  <div
                    class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col justify-between hover:border-blue-300 transition">
                    <div>
                      <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-slate-900">{{ $t->type }}</h3>
                        <span
                          class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200">
                          Stok: {{ $t->stock }}
                        </span>
                      </div>
                      <p class="text-xl font-extrabold text-blue-600 mb-3">
                        Rp {{ number_format($t->price, 0, ',', '.') }}
                      </p>
                      <div class="text-xs text-slate-500 border-t border-slate-200 pt-2">
                        <strong>Benefit:</strong> {{ $t->benefits }}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

          </div>

          {{-- KOLOM KANAN: GAMBAR & ACTION --}}
          <div class="lg:col-span-1 space-y-8">

            {{-- Upload Gambar --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-8">
              <h2 class="text-sm font-bold text-slate-700 mb-4 uppercase tracking-wider">Gambar Event</h2>

              <div class="mb-4">
                <label class="block text-xs text-slate-500 mb-2">Gambar Saat Ini:</label>
                <div class="relative rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                  <img
                    src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}"
                    class="w-full h-48 object-cover hover:scale-105 transition duration-500">
                </div>
              </div>

              <div class="border-t border-slate-100 pt-4">
                <label class="block text-sm font-bold text-slate-700 mb-2">Ganti Gambar (Opsional)</label>
                <label
                  class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition group">
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-2 text-slate-400 group-hover:text-blue-500 transition" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                      </path>
                    </svg>
                    <p class="text-xs text-slate-500 text-center px-2">Klik untuk upload gambar baru</p>
                  </div>
                  <input type="file" name="image" class="hidden">
                </label>
              </div>

              {{-- Action Buttons --}}
              <div class="mt-8 space-y-3">
                <button type="submit"
                  class="w-full py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all">
                  Simpan Perubahan
                </button>
                <a href="{{ route('admin.events') }}"
                  class="block w-full py-3 rounded-xl border border-slate-300 text-slate-600 font-bold text-center hover:bg-slate-50 transition">
                  Batal
                </a>
              </div>
            </div>

          </div>

        </div>
      </form>
    </div>
  </div>
@endsection