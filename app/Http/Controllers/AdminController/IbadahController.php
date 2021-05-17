<?php


namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\models\Desa;
use App\Ibadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IbadahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ibadah = Ibadah::with('desa')->orderby('created_at', 'desc')->get();
        return view('admin.ibadah.ibadah', compact('ibadah'));
    }

    public function create()
    {
        $desas = Desa::get();
        return view('admin.ibadah.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat_ibadah' => 'required|min:3',
            'desa' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'alamat' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $ibadah = new Ibadah();
        $ibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $ibadah->id_potensi = 2;
        $ibadah->agama = $request->agama;
        $ibadah->alamat = $request->alamat;
        $ibadah->lat = $request->lat;
        $ibadah->lng = $request->lng;
        $ibadah->id_desa = $request->desa;
        $ibadah->save();
        return redirect('admin/ibadah')->with('statusInput', 'Tempat Ibadah Berhasil Ditambahkan');
    }

    public function edit($id){
        $desas = Desa::get();
        $ibadah = Ibadah::find($id);
        return view('admin.ibadah.edit', compact('desas','ibadah'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat_ibadah' => 'required|min:3',
            'desa' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'alamat' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $ibadah = Ibadah::find($id);
        $ibadah->nama_tempat_ibadah = $request->nama_tempat_ibadah;
        $ibadah->agama = $request->agama;
        $ibadah->alamat = $request->alamat;
        $ibadah->lat = $request->lat;
        $ibadah->lng = $request->lng;
        $ibadah->id_desa = $request->desa;
        $ibadah->save();
        return redirect('admin/ibadah')->with('statusInput', 'Tempat Ibadah Berhasil Diperbaharui');
    }

    public function destroy($id){
        $ibadah = Ibadah::find($id);
        $ibadah->delete();
        return redirect('admin/ibadah')->with('statusInput', 'Tempat Ibadah Berhasil Dihapus');
    }

    public function show($id){
        $ibadah = Ibadah::with('desa')->find($id);
        return view('admin.ibadah.show', compact('ibadah'));
    }
}
