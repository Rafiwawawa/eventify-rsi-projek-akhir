@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

  {{-- CONTAINER UTAMA --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-16">

    {{-- 1. HERO SLIDER (STATIS) --}}
    <div class="relative">
      <div class="swiper w-full h-[280px] md:h-[450px] rounded-3xl overflow-hidden shadow-2xl group">

        <div class="swiper-wrapper">
          {{-- SLIDE 1 --}}
          <div class="swiper-slide relative">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1920&auto=format&fit=crop"
              class="w-full h-full object-cover" alt="Slide 1">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-10 left-8 md:left-12 right-8 text-white z-10">
              <h2 class="text-3xl md:text-5xl font-bold mb-2 drop-shadow-lg leading-tight">Temukan Hiburanmu</h2>
              <p class="text-white/90 text-sm md:text-lg">Jelajahi event seru di sekitarmu sekarang juga.</p>
            </div>
          </div>

          {{-- SLIDE 2 --}}
          <div class="swiper-slide relative">
            <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=1920&auto=format&fit=crop"
              class="w-full h-full object-cover" alt="Slide 2">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-10 left-8 md:left-12 right-8 text-white z-10">
              <h2 class="text-3xl md:text-5xl font-bold mb-2 drop-shadow-lg leading-tight">Konser Musik Terbesar</h2>
              <p class="text-white/90 text-sm md:text-lg">Dapatkan tiket presale sebelum kehabisan.</p>
            </div>
          </div>

          {{-- SLIDE 3 --}}
          <div class="swiper-slide relative">
            <img src="https://images.unsplash.com/photo-1514525253440-b393452e8d26?q=80&w=1920&auto=format&fit=crop"
              class="w-full h-full object-cover" alt="Slide 3">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-10 left-8 md:left-12 right-8 text-white z-10">
              <h2 class="text-3xl md:text-5xl font-bold mb-2 drop-shadow-lg leading-tight">Momen Tak Terlupakan</h2>
              <p class="text-white/90 text-sm md:text-lg">Buat kenangan indah bersama teman-temanmu.</p>
            </div>
          </div>
        </div>

        {{-- Navigasi Slider --}}
        <div class="swiper-pagination !bottom-6 !left-auto !right-6 !w-auto"></div>
        <div
          class="hidden md:flex swiper-button-next !w-12 !h-12 rounded-full bg-white/10 backdrop-blur-md hover:bg-white/30 !text-white after:!text-lg transition shadow-lg">
        </div>
        <div class="hidden md:flex swiper-button-prev !w-12 !h-12 rounded-full bg-white/10 backdrop-blur-md hover:bg-white/30 !text-white after:!text-lg transition shadow-lg"></div>
      </div>
    </div>


    {{-- 2. SECTION: EVENT POPULER --}}
    <section>
      <div class="flex items-end justify-between mb-8">
        <div>
          <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Event Populer 🔥</h2>
          <p class="text-slate-500 mt-2 text-base">Acara yang paling banyak diminati minggu ini.</p>
        </div>
        <a href="#" class="hidden md:flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-700 transition">
          Lihat Semua <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($popularEvents as $event)
          {{-- LOGIKA: Hanya tampilkan jika status 'open' --}}
          @if($event->status == 'open')
            <a href="{{ route('events.detail', $event->slug) }}"
              class="group bg-white rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full">

              {{-- Image Wrapper --}}
              <div class="relative h-52 overflow-hidden bg-slate-100">
                <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}"
                  class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">

                <div
                  class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                </div>

                <span
                  class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-slate-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm flex items-center gap-1">
                  📍 {{ $event->city }}
                </span>
              </div>

              {{-- Card Body --}}
              <div class="p-5 flex flex-col flex-grow">
                <div class="flex items-center gap-2 mb-3">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-wide">
                    {{ date('M', strtotime($event->event_date)) }}
                  </span>
                  <span class="text-xs font-medium text-slate-500">
                    {{ date('d, Y', strtotime($event->event_date)) }}
                  </span>
                </div>

                <h3
                  class="font-bold text-slate-900 text-lg leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                  {{ $event->title }}
                </h3>

                <p class="text-sm text-slate-500 mb-4 flex items-center gap-1.5">
                  <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="line-clamp-1">{{ $event->location }}</span>
                </p>

                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                  <span class="text-xs text-slate-400 font-medium">Mulai dari</span>
                  <span class="font-bold text-lg text-blue-600">
                    Rp {{ number_format($event->starting_price, 0, ',', '.') }}
                  </span>
                </div>
              </div>
            </a>
          @endif
        @empty
          <div class="col-span-full text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-300">
            <p class="text-slate-500">Belum ada event populer.</p>
          </div>
        @endforelse
      </div>
    </section>


    {{-- 3. SECTION: EVENT PILIHAN (FEATURED) --}}
    <section>
      <div class="flex items-center gap-3 mb-8">
        <div class="w-1.5 h-8 bg-gradient-to-b from-purple-500 to-indigo-600 rounded-full"></div>
        <div>
          <h2 class="text-2xl font-bold text-slate-900">Event Pilihan ✨</h2>
          <p class="text-sm text-slate-500">Dikurasi khusus untuk pengalaman terbaik.</p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($selectedEvents as $event)
          {{-- LOGIKA: Hanya tampilkan jika status 'open' --}}
          @if($event->status == 'open')
            <a href="{{ route('events.detail', $event->slug) }}"
              class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 aspect-[4/5] isolate">

              <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}"
                class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-700 -z-10">

              <div
                class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent opacity-90 transition">
              </div>

              <div class="absolute bottom-0 left-0 right-0 p-5 text-white flex flex-col h-full justify-end">
                <span
                  class="self-start px-2 py-1 bg-white/20 backdrop-blur-md border border-white/10 rounded-md text-[10px] font-bold uppercase tracking-wider mb-2">
                  {{ $event->city }}
                </span>
                <h3 class="font-bold text-xl leading-tight mb-1 drop-shadow-sm line-clamp-2">
                  {{ $event->title }}
                </h3>
                <p class="text-sm text-slate-300 mb-3">
                  {{ date('d M Y', strtotime($event->event_date)) }}
                </p>
                <div class="flex items-center justify-between border-t border-white/20 pt-3 mt-2">
                  <span class="text-xs text-white/70 line-clamp-1 max-w-[50%]">{{ $event->location }}</span>
                  <span class="font-bold text-yellow-400">
                    Rp {{ number_format($event->starting_price, 0, ',', '.') }}
                  </span>
                </div>
              </div>
            </a>
          @endif
        @empty
          <div class="col-span-full text-center py-10 text-slate-400">Belum ada event pilihan.</div>
        @endforelse
      </div>
    </section>


    {{-- 4. SECTION: EVENT DI KOTAMU --}}
    @if(Auth::check() && count($cityEvents) > 0)
      <section class="bg-blue-50/80 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-12 rounded-[2.5rem]">
        <div class="max-w-7xl mx-auto">
          <div class="flex items-center justify-between mb-8">
            <div>
              <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                Event di <span
                  class="text-blue-600 underline decoration-wavy decoration-blue-300 underline-offset-4">{{ Auth::user()->kota }}</span>
                🏠
              </h2>
              <p class="text-slate-500 text-sm mt-1">Jangan lewatkan keseruan di kotamu sendiri.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($cityEvents as $event)
              {{-- LOGIKA: Hanya tampilkan jika status 'open' --}}
              @if($event->status == 'open')
                <a href="{{ route('events.detail', $event->slug) }}"
                  class="group bg-white rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full">

                  <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}"
                      class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <span
                      class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-slate-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                      {{ $event->location }}
                    </span>
                  </div>

                  <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                      <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-wide">
                        {{ date('M', strtotime($event->event_date)) }}
                      </span>
                      <span class="text-xs font-medium text-slate-500">
                        {{ date('d, Y', strtotime($event->event_date)) }}
                      </span>
                    </div>

                    <h3
                      class="font-bold text-slate-900 text-lg leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                      {{ $event->title }}
                    </h3>

                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                      <span class="text-xs text-slate-400 font-medium">Mulai dari</span>
                      <p class="font-bold text-blue-600 text-lg">
                        Rp {{ number_format($event->starting_price, 0, ',', '.') }}
                      </p>
                    </div>
                  </div>
                </a>
              @endif
            @endforeach
          </div>
        </div>
      </section>
    @endif

  </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            effect: 'fade', // Efek pudar (ganti 'slide' jika ingin geser biasa)
            fadeEffect: { crossFade: true },
            speed: 800, // Kecepatan transisi
            
            // Autoplay
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endsection