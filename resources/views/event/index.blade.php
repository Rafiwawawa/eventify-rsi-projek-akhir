@extends('layouts.app')

@section('title', 'Jelajahi Konser')

@section('content')
{{-- Background abu-abu tipis --}}
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER & SEARCH SECTION --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Jelajahi Konser 🎸</h1>
            <p class="text-slate-500 text-lg mb-8">Temukan pengalaman konser seru dan event musik di seluruh Indonesia.</p>

            <form action="{{ route('events.search') }}" method="GET" class="relative group z-10">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    {{-- Icon Search --}}
                    <svg class="h-6 w-6 text-slate-400 group-focus-within:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari nama konser, artis, atau lokasi..."
                    class="block w-full pl-12 pr-4 py-4 bg-white border border-slate-200 text-slate-900 rounded-full shadow-sm placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-base font-medium">
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

            {{-- SIDEBAR FILTER --}}
            <div class="lg:col-span-1 lg:sticky lg:top-8 space-y-6">
                
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-slate-100">
                        <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                        <h2 class="font-bold text-slate-800 text-lg">Filter</h2>
                    </div>

                    <form action="{{ route('events.filter') }}" method="GET">
                        
                        {{-- FILTER KOTA --}}
                        <div class="mb-2">
                            <h3 class="font-semibold text-slate-900 mb-3 text-sm uppercase tracking-wider">Lokasi Kota</h3>
                            <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($kotaList as $city)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="checkbox"
                                            name="cities[]"
                                            value="{{ $city }}"
                                            {{ in_array($city, $selectedCities ?? []) ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-300 bg-slate-50 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400 focus:ring-2 focus:ring-blue-100">
                                            
                                        {{-- Custom Checkmark Icon --}}
                                        <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <span class="text-slate-600 group-hover:text-blue-600 transition text-sm font-medium">{{ $city }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- FILTER KATEGORI DIHAPUS DISINI --}}

                    </form>
                </div>
            </div>

            {{-- LIST EVENT --}}
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-bold text-xl text-slate-800">
                        Menampilkan <span class="text-blue-600">{{ count($events) }}</span> Konser
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse ($events as $event)
                    @if($event->status == 'open')
                    <a href="{{ route('events.detail', $event->slug) }}"
                        class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full">

                        {{-- Image Wrapper --}}
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            {{-- City Badge --}}
                            <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm text-slate-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm flex items-center gap-1">
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

                            <h3 class="font-bold text-slate-900 text-lg leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $event->title }}
                            </h3>

                            <p class="text-sm text-slate-500 mb-4 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
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
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                        <div class="mx-auto w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">Tidak ada konser ditemukan</h3>
                        <p class="text-slate-500 mt-1">Coba cari dengan kata kunci lain.</p>
                        <a href="{{ route('events.index') }}" class="inline-block mt-4 text-blue-600 font-semibold hover:underline">Reset Pencarian</a>
                    </div>
              
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>
@endsection