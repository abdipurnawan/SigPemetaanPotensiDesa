<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Desa;
use App\Sekolah;
use App\Ibadah;
use App\Wisata;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $jumlah_desa = Desa::where('deleted_at', NULL)->count();
        $jumlah_sekolah = Sekolah::where('deleted_at', NULL)->count();
        $jumlah_ibadah = Ibadah::where('deleted_at', NULL)->count();
        $jumlah_wisata = Wisata::where('deleted_at', NULL)->count();


        $desas = Desa::get();
        $sekolahs = Sekolah::with('potensi')->get();
        $ibadahs = Ibadah::with('potensi')->get();
        $wisatas = Wisata::with('potensi')->get();
        return view('admin.dashboard', compact('desas', 'sekolahs', 'ibadahs', 'wisatas', 'jumlah_desa', 'jumlah_sekolah', 'jumlah_ibadah', 'jumlah_wisata'));
    }
}
