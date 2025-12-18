@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6">

    <h2 class="text-xl font-bold text-center mb-4">Lupa Password</h2>

    <p class="text-sm text-center text-slate-600 mb-3">
        Masukkan email Anda untuk menerima link reset password.
    </p>

    @if (session('success'))
        <div class="text-green-600 text-sm mb-3">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="text-red-600 text-sm mb-3">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm">Email</label>
            <input type="email" name="email"
                   class="w-full border rounded-xl px-3 py-2 bg-slate-50" required>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold">
            Kirim Link Reset
        </button>
    </form>

    <p class="text-sm text-center mt-4">
        Kembali ke <a href="{{ route('login') }}" class="text-blue-600">Login</a>
    </p>

</div>
@endsection
