<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $kotaList = [
            'Jakarta','Surabaya','Bandung','Medan','Bekasi','Tangerang','Depok','Semarang','Palembang',
            'Makassar','Bogor','Batam','Padang','Denpasar','Malang','Yogyakarta','Solo','Balikpapan',
            'Banjarmasin','Pontianak','Manado','Pekanbaru','Samarinda'
        ];

        return view('profile.edit', compact('user', 'kotaList'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'gender'        => 'required|in:Laki-laki,Perempuan',
            'kota'          => 'required|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('profile', 'public');
            $user->profile_picture = $path;
        }

        $user->nama_lengkap  = $request->nama_lengkap;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->gender        = $request->gender;
        $user->kota          = $request->kota;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePasswordForm()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui.');
    }
}
