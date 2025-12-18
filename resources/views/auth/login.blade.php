@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  {{-- Wrapper Utama untuk centering (jika di layout belum ada) --}}
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-[#0EA5E9] via-white to-slate">
    {{-- Container Kartu --}}
    <div
      class="max-w-md w-full space-y-8 bg-white p-8 md:p-10 rounded-3xl shadow-2xl shadow-slate-600 border border-slate-100">

      {{-- HEADER --}}
      <div class="text-center">
        {{-- Logo Placeholder / Ikon --}}
        <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-600">
          <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang 👋</h2>
        <p class="mt-2 text-sm text-slate-500">Masuk untuk mengelola tiket dan event Anda.</p>
      </div>

      {{-- ALERT MESSAGES --}}
      @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2"
          role="alert">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-start gap-2"
          role="alert">
          <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      {{-- FORM LOGIN --}}
      <form action="{{ route('login.post') }}" method="POST" class="mt-8 space-y-6">
        @csrf

        <div class="space-y-5">
          {{-- Input Email --}}
          <div>
            <label class="block text-sm font-bold text-slate-700 mb-1 ml-1">Email Address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <input type="email" name="email" required
                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all sm:text-sm font-medium"
                placeholder="nama@email.com">
            </div>
          </div>

          {{-- Input Password --}}
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
                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all sm:text-sm font-medium"
                placeholder="••••••••">
            </div>
          </div>
        </div>

        {{-- Lupa Password --}}
        <div class="flex items-center justify-end">
          <a href="{{ route('password.request') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-500 hover:underline transition">
            Lupa password?
          </a>
        </div>

        {{-- Button Submit --}}
        <button type="submit"
          class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5">
          Masuk Sekarang
        </button>

      </form>

      {{-- Register Link --}}
      <div class="mt-6 text-center">
        <a href="{{ url('/') }}"
          class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-500 transition group">
          <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Kembali ke Beranda
        </a>
        <p class="pt-4 text-sm text-slate-600">
          Belum punya akun?
          <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-500 transition">
            Daftar gratis di sini
          </a>
        </p>
      </div>

    </div>
  </div>
@endsection