<?php


namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\models\Desa;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wisata = Wisata::with('desa')->orderby('created_at', 'desc')->get();
        return view('admin.wisata.wisata', compact('wisata'));
    }

    public function create()
    {
        $desa = Desa::get();
        return view('admin.wisata.create', compact('desa'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat_wisata' => 'required|min:3',
            'desa' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'deskripsi' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $wisata = new Wisata();
        $wisata->nama_tempat = $request->nama_tempat_wisata;
        $wisata->id_potensi = 3;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->alamat = $request->alamat;
        $wisata->lat = $request->lat;
        $wisata->lng = $request->lng;
        $wisata->id_desa = $request->desa;
        $wisata->save();
        return redirect('admin/wisata')->with('statusInput', 'Tempat Wisata Berhasil Ditambahkan');
    }

    public function edit($id){
        $desa = Desa::get();
        $wisata = Wisata::find($id);
        return view('admin.wisata.edit', compact('desa','wisata'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat_wisata' => 'required|min:3',
            'desa' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'deskripsi' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $wisata = Wisata::find($id);
        $wisata->nama_tempat = $request->nama_tempat_wisata;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->alamat = $request->alamat;
        $wisata->lat = $request->lat;
        $wisata->lng = $request->lng;
        $wisata->id_desa = $request->desa;
        $wisata->update();
        return redirect('admin/wisata')->with('statusInput', 'Tempat Wisata Berhasil Diperbaharui');
    }

    public function destroy($id){
        $wisata = Wisata::find($id);
        $wisata->delete();
        return redirect('admin/wisata')->with('statusInput', 'Tempat Wisata Berhasil Dihapus');
    }

    public function show($id){
        $wisata = Wisata::with('desa')->find($id);
        return view('admin.wisata.show', compact('wisata'));
    }
}
