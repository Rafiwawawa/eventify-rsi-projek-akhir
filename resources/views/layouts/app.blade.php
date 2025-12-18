<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Eventify</title>

  {{-- Google Fonts: Inter --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- Tailwind CSS --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>

  {{-- SwiperJS CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

  {{-- ========================================== --}}
  {{-- NAVBAR (Sticky & Glassmorphism) --}}
  {{-- ========================================== --}}
  <nav
    class="fixed w-full z-50 top-0 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">

        {{-- LEFT: LOGO --}}
        <div class="flex-shrink-0 flex items-center gap-8">
          <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
            <div
              class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg group-hover:rotate-12 transition">
              E
            </div>
            <span class="text-xl font-bold text-slate-900 tracking-tight">Eventify</span>
          </a>

          {{-- DESKTOP MENU --}}
          <div class="hidden md:flex space-x-6">
            <a href="{{ route('events') }}"
              class="text-sm font-medium {{ request()->routeIs('events*') ? 'text-blue-600' : 'text-slate-500 hover:text-blue-600' }} transition">
              Event
            </a>
            {{-- Menu Admin (Jika Login & Admin) --}}
            @auth
              @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.events') }}"
                  class="text-sm font-medium text-slate-500 hover:text-blue-600 transition">
                  Dashboard Admin
                </a>
              @endif
            @endauth
          </div>
        </div>

        {{-- RIGHT: ACTIONS --}}
        <div class="hidden md:flex items-center space-x-4">

          @guest
            <a href="{{ route('login') }}"
              class="text-sm font-medium text-slate-600 hover:text-blue-600 transition px-3 py-2">
              Masuk
            </a>
            <a href="{{ route('register') }}"
              class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-full transition shadow-lg shadow-blue-500/30">
              Daftar Sekarang
            </a>
          @endguest

          @auth

            {{-- Link Tiket --}}
            <a href="{{ route('tiket.saya') }}" class="p-2 text-slate-500 hover:text-blue-600 transition relative">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                </path>
              </svg>
            </a>

            {{-- PROFILE DROPDOWN --}}
            <div class="relative ml-2">
              <button onmouseenter="openDropdown()" onmouseleave="closeDropdown()"
                class="flex items-center gap-2 focus:outline-none">
                <img
                  src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama_lengkap) . '&background=random' }}"
                  class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm hover:border-blue-200 transition">
              </button>

              {{-- Dropdown Menu --}}
              <div id="profile-dropdown"
                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible transform -translate-y-2 transition-all duration-200 z-50"
                onmouseenter="keepDropdown()" onmouseleave="closeDropdown()">

                <div class="px-4 py-2 border-b border-slate-100 mb-1">
                  <p class="text-xs text-slate-400">Halo,</p>
                  <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->nama_lengkap }}</p>
                </div>

                <a href="/profile"
                  class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Profil Saya
                </a>

                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button
                    class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                      </path>
                    </svg>
                    Keluar
                  </button>
                </form>
              </div>
            </div>
          @endauth
        </div>

        {{-- MOBILE MENU BUTTON --}}
        <div class="flex items-center md:hidden">
          <button onclick="toggleMobileMenu()" class="text-slate-600 hover:text-blue-600 p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    {{-- MOBILE MENU (Hidden by default) --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 absolute w-full left-0 shadow-lg">
      <div class="px-4 pt-2 pb-6 space-y-1">
        <a href="{{ route('dashboard') }}"
          class="block px-3 py-2 text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 rounded-md">Beranda</a>
        <a href="{{ route('events') }}"
          class="block px-3 py-2 text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 rounded-md">Jelajah
          Event</a>

        @auth
          <a href="{{ route('tiket.saya') }}"
            class="block px-3 py-2 text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 rounded-md">Tiket
            Saya</a>
          <div class="border-t border-slate-100 my-2 pt-2">
            <div class="flex items-center px-3 gap-3 mb-3">
              <img
                src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama_lengkap) }}"
                class="w-8 h-8 rounded-full">
              <span class="font-semibold text-slate-800">{{ auth()->user()->nama_lengkap }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="w-full text-left px-3 py-2 text-red-600 font-medium">Keluar</button>
            </form>
          </div>
        @else
          <div class="grid grid-cols-2 gap-3 mt-4 px-3">
            <a href="{{ route('login') }}"
              class="text-center py-2 border border-slate-200 rounded-lg text-slate-600 font-medium">Masuk</a>
            <a href="{{ route('register') }}"
              class="text-center py-2 bg-blue-600 text-white rounded-lg font-medium">Daftar</a>
          </div>
        @endauth
      </div>
    </div>
  </nav>



  <main class="flex-grow pt-24 w-full">
    @yield('content')
  </main>


  {{-- ========================================== --}}
  {{-- FOOTER --}}
  {{-- ========================================== --}}
  <footer class="bg-slate-900 text-white pt-16 pb-8 border-t border-slate-800 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

        {{-- Brand --}}
        <div class="space-y-4">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">E
            </div>
            <span class="text-2xl font-bold tracking-tight">Eventify</span>
          </div>
          <p class="text-slate-400 text-sm leading-relaxed">
            Platform tiket event terpercaya di Indonesia. Temukan konser, workshop, dan festival favoritmu dalam satu
            genggaman.
          </p>
          <div class="flex space-x-4 pt-2">
            {{-- Social Icons --}}
            <a href="#" class="text-slate-400 hover:text-white transition"><svg class="w-5 h-5" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                  d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
              </svg></a>
            <a href="#" class="text-slate-400 hover:text-white transition"><svg class="w-5 h-5" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                  d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
              </svg></a>
          </div>
        </div>

        {{-- Kategori --}}
        <div>
          <h3 class="text-lg font-bold mb-6">Kategori Event</h3>
          <ul class="space-y-3 text-sm text-slate-400">
            <li><a href="#" class="hover:text-blue-400 transition">Konser Musik</a></li>
            <li><a href="#" class="hover:text-blue-400 transition">Workshop & Seminar</a></li>
            <li><a href="#" class="hover:text-blue-400 transition">Pameran Seni</a></li>
            <li><a href="#" class="hover:text-blue-400 transition">Olahraga</a></li>
            <li><a href="#" class="hover:text-blue-400 transition">Kuliner</a></li>
          </ul>
        </div>


        {{-- Kontak --}}
        <div>
          <h3 class="text-lg font-bold mb-6">Hubungi Kami</h3>
          <ul class="space-y-3 text-sm text-slate-400">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>Jl. Sudirman No. 123,<br>Jakarta Selatan, Indonesia</span>
            </li>
            <li class="flex items-center gap-3">
              <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
              </svg>
              <span>support@eventify.id</span>
            </li>
            <li class="flex items-center gap-3">
              <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                </path>
              </svg>
              <span>+62 21 5555 6789</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-slate-500 text-sm">© 2025 Eventify. All rights reserved.</p>
        <div class="flex space-x-6 text-sm text-slate-500">
          <a href="#" class="hover:text-white transition">Privacy</a>
          <a href="#" class="hover:text-white transition">Terms</a>
          <a href="#" class="hover:text-white transition">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>


  {{-- ========================================== --}}
  {{-- SCRIPTS --}}
  {{-- ========================================== --}}
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    // Logic Dropdown (Cleaned Up)
    const dropdown = document.getElementById('profile-dropdown');
    let timer;

    function openDropdown() {
      if (!dropdown) return;
      clearTimeout(timer);
      dropdown.classList.remove('invisible', 'opacity-0', '-translate-y-2');
    }

    function closeDropdown() {
      if (!dropdown) return;
      timer = setTimeout(() => {
        dropdown.classList.add('invisible', 'opacity-0', '-translate-y-2');
      }, 200);
    }

    function keepDropdown() {
      if (!dropdown) return;
      clearTimeout(timer);
    }

    // Logic Mobile Menu
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
  </script>

  @yield('scripts')
</body>

</html>