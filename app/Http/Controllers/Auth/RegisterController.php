<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $kotaList = $this->getKotaList();
        return view('auth.register', compact('kotaList'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'nomor_telepon'  => 'required|string|max:20',
            'gender'         => 'required|in:Laki-laki,Perempuan',
            'kota'           => 'required|string',
            'password'       => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'email'         => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'gender'        => $request->gender,
            'kota'          => $request->kota,
            'password'      => bcrypt($request->password),
            'is_verified'   => false,
        ]);

        // Generate OTP 6 digit
        $kode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Hapus OTP lama
        Otp::where('user_id', $user->id)->delete();

        // Buat OTP baru
        $otp = Otp::create([
            'user_id'    => $user->id,
            'kode'       => $kode,
            'expired_at' => now()->addMinute(),
        ]);

        // Kirim email OTP
        Mail::to($user->email)->send(new OtpMail($kode));

        return redirect()
            ->route('otp.form', ['email' => $user->email])
            ->with('email', $user->email);
    }

    public function showOtpForm(Request $request)
    {
        $email = session('email') ?? $request->query('email');

        if (!$email) {
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login kembali untuk verifikasi OTP.'
            ]);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('register')->withErrors([
                'email' => 'Email tidak valid.'
            ]);
        }

        $otp = Otp::where('user_id', $user->id)->latest()->first();
        $expiredAt = $otp ? $otp->expired_at : now();

        return view('auth.otp', compact('email', 'expiredAt'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'kode'  => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $otp = Otp::where('user_id', $user->id)
            ->where('kode', $request->kode)
            ->where('expired_at', '>', now())
            ->first();

        if (!$otp) {
            return redirect()
                ->route('otp.form', ['email' => $request->email])
                ->withErrors(['kode' => 'Kode OTP salah atau sudah kedaluwarsa.'])
                ->with('email', $request->email);
        }

        // Verifikasi user
        $user->update(['is_verified' => true]);
        $otp->delete();

        return redirect()->route('login')
            ->with('success', 'Akun berhasil diverifikasi. Silakan login.');
    }

    public function resendOtp(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->firstOrFail();

        Otp::where('user_id', $user->id)->delete();

        $kode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $otp = Otp::create([
            'user_id'    => $user->id,
            'kode'       => $kode,
            'expired_at' => now()->addMinute(),
        ]);

        Mail::to($user->email)->send(new OtpMail($kode));

        return redirect()
            ->route('otp.form', ['email' => $email])
            ->with('success', 'Kode OTP baru telah dikirim.')
            ->with('email', $email);
    }

    private function getKotaList(): array
    {
        return [
            'Jakarta','Surabaya','Bandung','Medan','Bekasi','Tangerang','Depok','Semarang','Palembang',
            'Makassar','Bogor','Batam','Padang','Denpasar','Malang','Yogyakarta','Solo','Balikpapan',
            'Banjarmasin','Pontianak','Manado','Pekanbaru','Samarinda'
        ];
    }
}
