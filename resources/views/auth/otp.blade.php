@extends('layouts.auth')

@section('title', 'Verifikasi OTP')

@section('content')
  <div class="h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">

    {{-- Container Kartu --}}
    <div class="max-w-md w-full bg-white p-8 md:p-10 rounded-3xl shadow-2xl shadow-slate-200/60 border border-slate-100">

      {{-- HEADER ICON (Tanpa link kembali di atas) --}}
      <div class="text-center mb-6">
        <div
          class="mx-auto h-16 w-16 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600 animate-pulse">
          <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Verifikasi Akun 🔐</h2>
        <div class="mt-2 text-sm text-slate-500">
          Kami telah mengirimkan kode OTP ke: <br>
          <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded mt-1 inline-block">{{ $email }}</span>
        </div>
      </div>

      {{-- ALERTS --}}
      @if (session('success'))
        <div
          class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-start gap-2">
          <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('otp.verify') }}" class="mt-6">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="kode" id="kode_otp">

        {{-- OTP INPUTS --}}
        <div class="flex justify-between gap-2 mb-8">
          @for ($i = 0; $i < 6; $i++)
            <input type="text" maxlength="1"
              class="otp-box w-12 h-14 md:w-14 md:h-16 text-center text-2xl font-bold border-2 border-slate-200 rounded-xl bg-white text-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition-all shadow-sm placeholder-slate-300"
              oninput="moveNext(this)" onkeypress="return isNumber(event)">
          @endfor
        </div>

        <button
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5">
          Verifikasi Sekarang
        </button>

        {{-- TIMER & RESEND --}}
        <div class="mt-6 text-center">
          <div class="flex items-center justify-center gap-2 text-sm text-slate-500 mb-4">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Kode kedaluwarsa dalam <span id="timer" class="font-bold text-slate-800">...</span> detik</span>
          </div>

          {{-- Link Kirim Ulang (Hidden by default) --}}
          <a href="{{ route('otp.resend', ['email' => $email]) }}" id="resend-btn"
            class="hidden inline-flex items-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-700 transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Kirim Ulang Kode
          </a>
        </div>

      </form>

      {{-- NAVIGASI KEMBALI DI BAWAH --}}
      <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <a href="{{ route('register') }}"
          class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-500 transition group">
          <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Kembali ke Register
        </a>
      </div>

    </div>
  </div>

  <script>
    let inputs = document.querySelectorAll('.otp-box');
    let hiddenInput = document.getElementById('kode_otp');

    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }

    function moveNext(el) {
      el.value = el.value.replace(/[^0-9]/g, '');

      if (el.value.length === 1) {
        let next = el.nextElementSibling;
        if (next) next.focus();
      }

      let code = '';
      inputs.forEach(i => code += (i.value || ''));
      hiddenInput.value = code;
    }

    inputs.forEach((input, index) => {
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '') {
          if (index > 0) {
            inputs[index - 1].focus();
          }
        }
      });
    });

    // TIMER FIX
    let expiredAt = new Date("{{ $expiredAt }}").getTime();

    function updateTimer() {
      let now = new Date().getTime();
      let diff = expiredAt - now;

      let seconds = Math.floor(diff / 1000);

      if (seconds <= 0) {
        document.getElementById('timer').innerText = 0;
        document.getElementById('resend-btn').classList.remove('hidden');
        return;
      }

      document.getElementById('timer').innerText = seconds;

      setTimeout(updateTimer, 1000);
    }

    updateTimer();
  </script>

@endsection