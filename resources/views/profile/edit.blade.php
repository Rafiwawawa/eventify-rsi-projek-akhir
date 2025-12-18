@extends('layouts.app')

@section('content')
  {{-- Menggunakan py-12 tanpa min-h-screen agar footer naik wajar --}}
  <div class="bg-slate-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

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
            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-slate-900">Edit Profil ✏️</h2>
              <p class="text-sm text-slate-500">Perbarui informasi pribadi Anda.</p>
            </div>
          </div>
          <hr class="mt-6 border-slate-100">
        </div>

        <div class="p-8 pt-6">
          <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Nama Lengkap</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required
                  class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm">
              </div>
            </div>

            {{-- Nomor Telepon --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Nomor Telepon</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                </div>
                <input type="text" name="nomor_telepon" value="{{ $user->nomor_telepon }}" required
                  class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium sm:text-sm">
              </div>
            </div>

            {{-- Grid Gender & Kota --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

              {{-- Gender --}}
              <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Gender</label>
                <div class="relative">
                  <select name="gender" required
                    class="w-full pl-3 pr-8 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer font-medium sm:text-sm">
                    <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Kota</label>
                <div class="relative">
                  <select name="kota" required
                    class="w-full pl-3 pr-8 py-3 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer font-medium sm:text-sm">
                    @foreach ($kotaList as $kota)
                      <option value="{{ $kota }}" {{ $user->kota == $kota ? 'selected' : '' }}>{{ $kota }}</option>
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

            {{-- Foto Profil --}}
            <div>
              <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Foto Profil</label>
              <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                  class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition relative group">

                  {{-- Preview Text --}}
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-3 text-slate-400 group-hover:text-blue-500 transition" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-1 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span> atau drag
                      foto</p>
                    <p class="text-xs text-slate-400">SVG, PNG, JPG (Max. 2MB)</p>
                  </div>

                  {{-- Input File yang sebenarnya (class khusus Tailwind untuk styling file input) --}}
                  <input id="dropzone-file" type="file" name="foto"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </label>
              </div>

              {{-- Menampilkan Nama File (Opsional, perlu JS kecil, tapi tampilan dasar sudah oke) --}}
              @if($user->profile_picture)
                <p class="text-xs text-slate-500 mt-2 ml-1">
                  Foto saat ini: <span class="font-medium text-slate-700">Terpasang</span>
                </p>
              @endif
            </div>

            {{-- Tombol Simpan --}}
            <div class="pt-4">
              <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <span>Simpan Perubahan</span>
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