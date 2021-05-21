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

    public function desa()
    {
        $desas = Desa::get();
        return view('desa', compact('desas'));
    }

    public function sekolah()
    {
        $desas = Desa::get();
        $sekolahs = Sekolah::with('potensi')->get();
        return view('sekolah', compact('desas', 'sekolahs'));
    }

    public function ibadah()
    {
        $desas = Desa::get();
        $ibadahs = Ibadah::with('potensi')->get();
        return view('ibadah', compact('desas', 'ibadahs'));
    }

    public function wisata()
    {
        $desas = Desa::get();
        $wisatas = Wisata::with('potensi')->get();
        return view('wisata', compact('desas', 'wisatas'));
    }

    public function getDetailDesa($id){
        $desa = Desa::find($id);
        $jumlah_sekolah = Sekolah::where('id_desa', $id)->count();
        $jumlah_ibadah = Ibadah::where('id_desa', $id)->count();
        $jumlah_wisata = Wisata::where('id_desa', $id)->count();
        return response()->json(['success' => 'Berhasil', 'desa' => $desa, 'jumlah_sekolah' => $jumlah_sekolah, 'jumlah_ibadah' => $jumlah_ibadah, 'jumlah_wisata' => $jumlah_wisata]);
    }

    public function getDetailSekolah($id){
        $sekolah = Sekolah::with('desa')->find($id);
        return response()->json(['success' => 'Berhasil', 'sekolah' => $sekolah]);
    }

    public function getDetailIbadah($id){
        $ibadah = Ibadah::with('desa')->find($id);
        return response()->json(['success' => 'Berhasil', 'ibadah' => $ibadah]);
    }

    public function getDetailWisata($id){
        $wisata = Wisata::with('desa')->find($id);
        return response()->json(['success' => 'Berhasil', 'wisata' => $wisata]);
    }
}
