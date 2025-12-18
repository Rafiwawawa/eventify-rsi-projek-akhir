<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LupaPasswordController extends Controller
{
    // FORM: input email
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // PROSES: kirim email reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        // Hapus token lama
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Simpan token baru
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Kirim email
        Mail::send('emails.reset-password', [
            'token' => $token,
            'email' => $request->email
        ], function ($msg) use ($request) {
            $msg->to($request->email);
            $msg->subject('Reset Password Akun Eventify');
        });

        return back()->with('success', 'Link reset password telah dikirimkan ke email Anda.');
    }

    // FORM: reset password
    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    // PROSES: update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
            'email' => 'required|email|exists:users,email'
        ]);

        // Cek token
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors([
                'token' => 'Token tidak valid atau sudah kedaluwarsa.'
            ]);
        }

        // Update password user
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()
            ->route('login')
            ->with('success', 'Password berhasil direset. Silakan login.');
    }
}
