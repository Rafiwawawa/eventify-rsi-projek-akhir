@extends('layouts.auth')

@section('content')
  {{-- PERUBAHAN: Menghapus 'min-h-screen' agar footer naik mendekati konten --}}
  <div class="h-screen w-full flex items-center justify-center bg-slate-50 py-12">
    <div class="max-w-xl mx-auto px-4 sm:px-6">

      {{-- NAVIGASI KEMBALI --}}
      <div class="mb-6">
        <a href="{{ route('profile') }}"
          class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition group">
          <div
            class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mr-2 shadow-sm group-hover:border-blue-200 group-hover:bg-blue-50 transition">
            <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
          </div>
          Kembali ke Profil
        </a>
      </div>

      {{-- MAIN CARD --}}
      <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">

        {{-- Header --}}
        <div class="p-8 pb-0">
          <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-slate-900">Ganti Password 🔐</h2>
              <p class="text-sm text-slate-500">Perbarui kata sandi Anda secara berkala untuk keamanan.</p>
            </div>
          </div>
          <hr class="mt-6 border-slate-100">
        </div>

        <div class="p-8 pt-6">

          {{-- ALERT ERROR --}}
          @if ($errors->any())
            <div
              class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-start gap-2">
              <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>{{ $errors->first() }}</span>
            </div>
          @endif

          <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
            @csrf

            {{-- Password Lama --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Password Lama</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                  </svg>
                </div>
                <input type="password" name="current_password" required
                  class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
                  placeholder="Masukkan password saat ini">
              </div>
            </div>

            {{-- Password Baru --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Password Baru</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
                <input type="password" name="password" required
                  class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
                  placeholder="Minimal 8 karakter">
              </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Konfirmasi Password Baru</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <input type="password" name="password_confirmation" required
                  class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm"
                  placeholder="Ulangi password baru">
              </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="pt-4">
              <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <span>Update Password</span>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
@endsection