@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    
    {{-- ========================================================================
         1. HERO SECTION (BANNER GAMBAR)
         ======================================================================== --}}
    <div class="relative w-full bg-slate-900 pb-32 lg:pb-40 pt-10 px-4 sm:px-6 lg:px-8">
         {{-- Background Image dengan Blur Effect (Estetik) --}}
         <div class="absolute inset-0 overflow-hidden">
            <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" 
                 class="w-full h-full object-cover opacity-30 blur-xl scale-110">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/0 via-slate-900/60 to-slate-50"></div>
         </div>

         {{-- Gambar Utama (Boxed & Rounded) --}}
         <div class="relative max-w-7xl mx-auto z-10">
            <div class="w-full h-[300px] md:h-[450px] rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20">
                <img src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" 
                     class="w-full h-full object-cover">
            </div>
         </div>
    </div>


    {{-- ========================================================================
         2. MAIN CONTENT GRID
         ======================================================================== --}}
    {{-- Margin top negatif (-mt-20) agar konten naik menumpuk banner sedikit --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 z-20">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- >>>>> KOLOM KIRI: INFORMASI EVENT <<<<< --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Header Info Event --}}
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('events') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition mb-6 group">
                        <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Kembali ke Event
                    </a>

                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider rounded-full mb-3 border border-blue-100">
                                📍 {{ $event->city }}
                            </span>
                            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                                {{ $event->title }}
                            </h1>
                        </div>
                    </div>

                    {{-- Meta Info Bar (Tanggal & Waktu) --}}
                    <div class="flex flex-wrap gap-4 mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-3 text-slate-600">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase">Tanggal</p>
                                <p class="font-semibold text-slate-900">{{ date('d F Y', strtotime($event->event_date)) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-slate-600">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase">Waktu</p>
                                <p class="font-semibold text-slate-900">{{ date('H:i', strtotime($event->event_time)) }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h2 class="font-bold text-2xl text-slate-900 mb-4">Deskripsi Event</h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {{ $event->description }}
                    </div>
                </div>

                {{-- Informasi Tambahan --}}
                @if($event->additional_info)
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h2 class="font-bold text-lg text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Informasi Tambahan
                    </h2>
                    <p class="text-slate-600 leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($event->additional_info)) !!}
                    </p>
                </div>
                @endif

                {{-- Alert Info Penting --}}
                <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl flex gap-4 items-start">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-1">Informasi Penting</h3>
                        <p class="text-blue-800/80 text-sm leading-relaxed">
                            Konfirmasi kehadiran akan dikirim via email H-3 sebelum event. Pastikan email Anda aktif untuk menerima notifikasi.
                        </p>
                    </div>
                </div>

            </div>


            {{-- >>>>> KOLOM KANAN: PEMBELIAN TIKET (STICKY) <<<<< --}}
            <div class="lg:col-span-1">
                {{-- Sticky Container: Agar tetap terlihat saat scroll --}}
                <div class="sticky top-8 space-y-6">

                    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                        
                        {{-- Header Card Tiket --}}
                        <div class="bg-slate-900 p-6 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                            <h2 class="font-bold text-xl relative z-10 flex items-center gap-2">
                                Amankan Tiketmu! 🎟️
                            </h2>
                            <p class="text-slate-300 text-sm mt-1 relative z-10">Jangan sampai kehabisan slot.</p>
                        </div>

                        {{-- Body Card Tiket --}}
                        <div class="p-6">
                             {{-- Info Lokasi --}}
                             <div class="mb-6 pb-6 border-b border-slate-100">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <div>
                                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">Lokasi</p>
                                        <p class="font-medium text-slate-900">{{ $event->location }}</p>
                                    </div>
                                </div>
                             </div>

                            {{-- FORM PEMESANAN --}}
                            <form action="{{ route('pesan.checkout') }}" method="GET" id="ticketForm">
                                <h3 class="font-bold text-slate-900 mb-4 text-sm uppercase tracking-wide">Pilih Kategori Tiket</h3>

                                <div class="space-y-3">
                                    {{-- Looping Tiket dari Database --}}
                                    @forelse ($event->tickets as $ticket)
                                        <label class="group relative block p-4 rounded-xl border cursor-pointer transition-all duration-200 ticket-card border-slate-200 hover:border-blue-400 bg-white">
                                            
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <span class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition">
                                                        {{ $ticket->type }}
                                                    </span>
                                                    {{-- Cek Stok --}}
                                                    <p class="text-xs text-slate-500 mt-0.5">
                                                        {{ $ticket->stock > 0 ? $ticket->stock . ' tiket tersedia' : 'Habis Terjual' }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-bold text-blue-600 text-lg">
                                                        Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- List Benefits (Jika ada) --}}
                                            @if($ticket->benefits)
                                            <ul class="space-y-1 mb-3">
                                                @foreach (explode('|', $ticket->benefits) as $benefit)
                                                    <li class="flex items-center text-xs text-slate-600">
                                                        <svg class="w-3 h-3 text-green-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                                        {{ trim($benefit) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            {{-- Radio Button --}}
                                            <div class="flex items-center justify-between border-t border-dashed border-slate-200 pt-3 mt-3">
                                                <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition">Pilih tiket ini</span>
                                                <input type="radio" name="ticket_id" value="{{ $ticket->id }}" required 
                                                    {{ $ticket->stock <= 0 ? 'disabled' : '' }}
                                                    class="h-5 w-5 border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer disabled:opacity-50">
                                            </div>

                                            {{-- Overlay Stok Habis --}}
                                            @if($ticket->stock <= 0)
                                            <div class="absolute inset-0 bg-slate-50/70 cursor-not-allowed flex items-center justify-center rounded-xl z-10">
                                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded shadow-sm">SOLD OUT</span>
                                            </div>
                                            @endif

                                            {{-- Border Active Highlight (via JS) --}}
                                            <div class="absolute inset-0 rounded-xl border-2 border-transparent pointer-events-none transition-all active-border"></div>
                                        </label>
                                    @empty
                                        {{-- Empty State (Jika Admin belum input tiket) --}}
                                        <div class="text-center py-8 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                                            <p class="text-slate-500 text-sm font-medium">Tiket belum tersedia.</p>
                                        </div>
                                    @endforelse

                                </div>

                                {{-- Tombol Submit --}}
                                @if(count($event->tickets) > 0)
                                <button type="submit"
                                    class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3.5 px-4 rounded-xl font-bold shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    Lanjutkan Pembayaran
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                </button>
                                @endif
                            </form>
                        </div>
                        
                        {{-- Footer Card --}}
                        <div class="bg-slate-50 p-4 border-t border-slate-100 text-center">
                            <p class="text-xs text-slate-500 flex items-center justify-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                Pembayaran Aman & Terpercaya
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script untuk interaksi visual (Highlight Card saat diklik) --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const radioButtons = document.querySelectorAll("input[name='ticket_id']");
    
    radioButtons.forEach(radio => {
        radio.addEventListener("change", function () {
            // 1. Reset style semua card ke default (putih)
            document.querySelectorAll(".ticket-card").forEach(card => {
                card.classList.remove("border-blue-600", "bg-blue-50/50", "ring-1", "ring-blue-600");
                card.classList.add("border-slate-200", "bg-white");
            });

            // 2. Berikan style highlight ke card yang dipilih
            const selectedCard = this.closest(".ticket-card");
            if(selectedCard) {
                selectedCard.classList.remove("border-slate-200", "bg-white");
                selectedCard.classList.add("border-blue-600", "bg-blue-50/50", "ring-1", "ring-blue-600");
            }
        });
    });
});
</script>
@endsection