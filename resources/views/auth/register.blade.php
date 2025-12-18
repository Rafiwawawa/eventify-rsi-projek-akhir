@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
  <div class="h-screen w-full flex items-center justify-center bg-slate-50 px-4 ">

    <div class="max-w-lg w-full bg-white p-8 md:p-10 rounded-3xl shadow-2xl shadow-slate-200/40 order border-slate-100">

      {{-- HEADER --}}
      <div class="text-center mb-8">
        <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-600">
          <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buat Akun Baru 🚀</h2>
        <p class="mt-2 text-sm text-slate-500">Bergabunglah untuk memesan tiket event favoritmu.</p>
      </div>

      {{-- ERROR ALERT --}}
      @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
          <div class="flex items-center gap-2 font-bold mb-1">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Periksa Input Anda
          </div>
          <ul class="list-disc ml-8 space-y-1 text-xs">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- FORM REGISTER --}}
      <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Nama Lengkap</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap') }}"
              class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
              placeholder="Jhon Doe">
          </div>
        </div>

        {{-- Email --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <input type="email" name="email" required value="{{ old('email') }}"
              class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
              placeholder="nama@email.com">
          </div>
        </div>

        {{-- Nomor Telepon --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Nomor Telepon</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <input type="text" name="nomor_telepon" required value="{{ old('nomor_telepon') }}"
              class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
              placeholder="08123456789">
          </div>
        </div>

        {{-- GRID: GENDER & KOTA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          {{-- Gender --}}
          <div>
            <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Gender</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <select name="gender" required
                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm cursor-pointer">
                <option value="">Pilih Gender</option>
                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>

          {{-- Kota --}}
          <div>
            <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Kota</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <select name="kota" required
                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm cursor-pointer">
                <option value="">Pilih Kota</option>
                @foreach ($kotaList as $kota)
                  <option value="{{ $kota }}" {{ old('kota') == $kota ? 'selected' : '' }}>{{ $kota }}</option>
                @endforeach
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        {{-- Password --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <input type="password" name="password" required
              class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
              placeholder="••••••••">
          </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Konfirmasi Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <input type="password" name="password_confirmation" required
              class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
              placeholder="Ulangi password">
          </div>
        </div>

        {{-- Button Daftar --}}
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5 mt-6">
          Daftar Sekarang
        </button>
      </form>

      {{-- Footer Link Wrapper --}}
      <div class="mt-8 border-t border-slate-100 text-center flex flex-col items-center gap-3">
        {{-- 1. TULISAN DI ATAS (Kembali ke Beranda) --}}
        <a href="{{ url('/') }}"
          class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-500 transition group">
          <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Kembali ke Beranda
        </a>
        {{-- 2. TULISAN DI BAWAH (Sudah punya akun?) --}}
        <p class="text-sm text-slate-600">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 transition">
            Masuk disini
          </a>
        </p>
      </div>

    </div>
  </div>
@endsection