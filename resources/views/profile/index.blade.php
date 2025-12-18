@extends('layouts.app')

@section('content')
  <div class="bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

      {{-- MAIN CARD --}}
      <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">

        {{-- 1. COVER HEADER (Gradient Background) --}}
        <div class="h-32 md:h-48 bg-gradient-to-r from-blue-600 to-indigo-600 relative">
          {{-- Dekorasi Pattern (Opsional) --}}
          <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
          </div>
        </div>

        <div class="px-6 md:px-10 pb-8">

          {{-- 2. HEADER PROFIL (Foto & Nama) --}}
          <div
            class="relative flex flex-col md:flex-row items-center md:items-end -mt-12 md:-mt-16 mb-8 gap-6 text-center md:text-left">

            {{-- Foto Profil --}}
            <div class="relative">
              <img
                src="{{ $user->profile_picture ? (str_starts_with($user->profile_picture, 'http') ? $user->profile_picture : asset('storage/' . $user->profile_picture)) : asset('images/default-profile.jpeg') }}"
                class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-white shadow-lg bg-white">

              {{-- Status Badge (Hiasan) --}}
              <div class="absolute bottom-2 right-2 bg-green-500 w-5 h-5 rounded-full border-4 border-white"
                title="Online"></div>
            </div>

            {{-- Nama & Email --}}
            <div class="flex-grow pb-2">
              <h1 class="text-3xl font-extrabold text-slate-900">{{ $user->nama_lengkap }}</h1>
              <p class="text-slate-500 font-medium flex items-center justify-center md:justify-start gap-1.5 mt-1">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ $user->email }}
              </p>
            </div>

            {{-- Tombol Aksi (Desktop) --}}
            <div class="hidden md:flex gap-3 pb-2">
              <a href="{{ route('profile.password') }}"
                class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 hover:text-slate-900 transition text-sm">
                Ganti Password
              </a>
              <a href="{{ route('profile.edit') }}"
                class="px-5 py-2.5 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 transition text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profil
              </a>
            </div>
          </div>

          {{-- Divider --}}
          <div class="border-t border-slate-100 my-6"></div>

          {{-- 3. INFORMASI DETAIL (GRID) --}}
          <h2 class="text-lg font-bold text-slate-800 mb-4">Informasi Pribadi</h2>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Card: Nomor Telepon --}}
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
              <div
                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Telepon</p>
                <p class="font-semibold text-slate-900">{{ $user->nomor_telepon }}</p>
              </div>
            </div>

            {{-- Card: Gender --}}
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
              <div
                class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                <p class="font-semibold text-slate-900">{{ $user->gender }}</p>
              </div>
            </div>

            {{-- Card: Kota --}}
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
              <div
                class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kota Asal</p>
                <p class="font-semibold text-slate-900">{{ $user->kota }}</p>
              </div>
            </div>

          </div>

          {{-- 4. TOMBOL AKSI (MOBILE ONLY) --}}
          <div class="flex flex-col gap-3 mt-8 md:hidden">
            <a href="{{ route('profile.edit') }}"
              class="w-full py-3 rounded-xl bg-blue-600 text-white font-bold text-center shadow-lg shadow-blue-600/30">
              Edit Profil
            </a>
            <a href="{{ route('profile.password') }}"
              class="w-full py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-center hover:bg-slate-50">
              Ganti Password
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection