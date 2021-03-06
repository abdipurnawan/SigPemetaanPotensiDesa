<?php


namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $desa = Desa::orderby('created_at', 'desc')->get();
        return view('admin.desa.desa', compact('desa'));
    }

    public function create()
    {
        return view('admin.desa.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_desa' => 'required|min:3',
            'batas_desa' => 'required|min:8'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $desa = new Desa();
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->warna_batas = $request->warna_batas;
        $desa->save();
        return redirect('admin/desa')->with('statusInput', 'Desa Berhasil Ditambahkan');
    }

    public function edit($id){
        $desa = Desa::find($id);
        return view('admin.desa.edit', compact('desa'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_desa' => 'required|min:3',
            'batas_desa' => 'required|min:8'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $desa = Desa::find($id);
        $desa->nama_desa = $request->nama_desa;
        $desa->batas_desa = $request->batas_desa;
        $desa->warna_batas = $request->warna_batas;
        $desa->update();
        return redirect('admin/desa')->with('statusInput', 'Desa Berhasil Diperbaharui');
    }

    public function destroy($id){
        $desa = Desa::find($id);
        $desa->delete();
        return redirect('admin/ibadah')->with('statusInput', 'Tempat Ibadah Berhasil Dihapus');
    }

    public function show($id){
        $desa = Desa::find($id);
        return view('admin.desa.show', compact('desa'));
    }
}
