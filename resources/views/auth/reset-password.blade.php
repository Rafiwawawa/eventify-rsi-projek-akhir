@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6">

    <h2 class="text-xl font-bold text-center mb-4">Reset Password</h2>

    @if ($errors->any())
        <div class="text-red-600 text-sm mb-3">{{ $errors->first() }}</div>
    @endif

    @if (session('success'))
        <div class="text-green-600 text-sm mb-3">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        {{-- Token --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email disisipkan otomatis --}}
        <input type="hidden" name="email" value="{{ request()->query('email') }}">

        <div>
            <label class="text-sm font-medium">Password Baru</label>
            <input type="password" name="password"
                   class="w-full border rounded-xl px-3 py-2 bg-slate-50" required>
        </div>

        <div>
            <label class="text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded-xl px-3 py-2 bg-slate-50" required>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold">
            Reset Password
        </button>
    </form>

</div>
@endsection
