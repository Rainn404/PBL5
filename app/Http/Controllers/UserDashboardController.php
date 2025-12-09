<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.dashboard');
    }

    public function profil()
    {
        return view('user.profil');
    }

    public function pesan()
    {
        return view('user.pesan');
    }

    public function statistik()
    {
        return view('user.statistik');
    }
}
