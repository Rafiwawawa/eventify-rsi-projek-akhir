<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
}
