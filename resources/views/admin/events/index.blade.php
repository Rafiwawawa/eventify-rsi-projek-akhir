@extends('layouts.app')

@section('title', 'Admin - Daftar Event')

@section('content')
  <div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER --}}
      <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
          <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
            <span class="text-slate-800 font-medium">Admin Panel</span>
            <span>/</span>
            <span>Manajemen Event</span>
          </div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Event 📅</h1>
        </div>

        <a href="{{ route('admin.event.create') }}"
          class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Buat Event Baru
        </a>
      </div>

      {{-- TABLE CARD --}}
      <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                <th class="px-6 py-4 font-semibold">Judul Event</th>
                {{-- Kolom Kategori Dihapus --}}
                <th class="px-6 py-4 font-semibold text-center">Status</th>
                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse ($events as $event)
                <tr class="hover:bg-slate-50/80 transition group">

                  {{-- Judul --}}
                  <td class="px-6 py-4">
                    <p class="font-bold text-slate-900">{{ $event->title }}</p>
                    <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-1">
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      {{ $event->city }}
                    </p>
                  </td>

                  {{-- Data Kategori Dihapus --}}

                  {{-- Status --}}
                  <td class="px-6 py-4 text-center">
                    @if($event->status == 'open')
                      <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Open
                      </span>
                    @else
                      <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        Closed
                      </span>
                    @endif
                  </td>

                  {{-- Aksi --}}
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-2">

                      {{-- Tombol Rekap --}}
                      <a href="{{ route('admin.event.rekap', $event->id) }}"
                        class="p-2 rounded-lg text-indigo-600 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100"
                        title="Lihat Rekap">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                      </a>

                      {{-- Tombol Edit --}}
                      <a href="{{ route('admin.event.edit', $event->id) }}"
                        class="p-2 rounded-lg text-amber-500 hover:bg-amber-50 transition border border-transparent hover:border-amber-100"
                        title="Edit Event">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                      </a>

                      {{-- Tombol Tutup (Form) --}}
                      @if($event->status == 'open')
                        <form action="{{ route('admin.event.tutup', $event->id) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Yakin ingin menutup event ini? Setelah ditutup, event tidak bisa dibuka kembali.');">
                          @csrf
                          <button
                            class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition border border-transparent hover:border-red-100"
                            title="Tutup Event">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                          </button>
                        </form>
                      @else
                        {{-- Jika closed, tampilkan icon gembok disabled --}}
                        <span class="p-2 rounded-lg text-slate-300 cursor-not-allowed" title="Sudah Ditutup">
                          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                          </svg>
                        </span>
                      @endif

                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center text-slate-400">
                      <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                      </div>
                      <h3 class="text-lg font-medium text-slate-900">Belum ada event</h3>
                      <p class="text-sm text-slate-500 mt-1">Mulai buat event pertama Anda sekarang.</p>
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