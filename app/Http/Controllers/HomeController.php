<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Desa;
use App\Sekolah;
use App\Ibadah;
use App\Wisata;

class HomeController extends Controller
{

    public function index()
    {
        $desas = Desa::get();
        $sekolahs = Sekolah::with('potensi')->get();
        $ibadahs = Ibadah::with('potensi')->get();
        $wisatas = Wisata::with('potensi')->get();
        return view('welcome', compact('desas', 'sekolahs', 'ibadahs', 'wisatas'));
    }

    public function getDetailSekolah($id){
        $sekolah = Sekolah::with('desa')->find($id);
        return response()->json(['success' => 'Berhasil', 'sekolah' => $sekolah]);
    }
}
