<?php


namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\models\Desa;
use App\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sekolah = Sekolah::with('desa')->orderby('created_at', 'desc')->get();
        return view('admin.sekolah.sekolah', compact('sekolah'));
    }

    public function create()
    {
        $desas = Desa::get();
        return view('admin.sekolah.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sekolah' => 'required|min:3',
            'desa' => 'required',
            'jenis' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $sekolah = new Sekolah();
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->id_potensi = 1;
        $sekolah->jenis = $request->jenis;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->id_desa = $request->desa;

        $image_parts = explode(';base64', $request->foto);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid().'.png';
        $fileLocation = '/image/sekolah/'.$request->nama_sekolah;
        $path = $fileLocation."/".$filename;
        $sekolah->foto = '/storage'.$path;
        Storage::disk('public')->put($path, $image_base64);

        $sekolah->save();
        return redirect('admin/sekolah')->with('statusInput', 'Sekolah Berhasil Ditambahkan');
    }

    public function edit($id){
        $desas = Desa::get();
        $sekolah = Sekolah::find($id);
        return view('admin.sekolah.edit', compact('desas','sekolah'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sekolah' => 'required|min:3',
            'desa' => 'required',
            'jenis' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $sekolah = Sekolah::find($id);
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->jenis = $request->jenis;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->lat = $request->lat;
        $sekolah->lng = $request->lng;
        $sekolah->id_desa = $request->desa;
        if($request->foto!=''){
            Storage::disk('public')->delete($sekolah->foto);
            $image_parts = explode(';base64', $request->foto);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = uniqid().'.png';
            $fileLocation = '/image/sekolah/'.$request->nama_sekolah;
            $path = $fileLocation."/".$filename;
            $sekolah->foto = '/storage'.$path;
            Storage::disk('public')->put($path, $image_base64);
        }
        $sekolah->update();
        return redirect('admin/sekolah')->with('statusInput', 'Sekolah Berhasil Diperbaharui');
    }

    public function destroy($id){
        $sekolah = Sekolah::find($id);
        $sekolah->delete();
        return redirect('admin/sekolah')->with('statusInput', 'Sekolah Berhasil Dihapus');
    }

    public function show($id){
        $sekolah = Sekolah::with('desa')->find($id);
        return view('admin.sekolah.show', compact('sekolah'));
    }
}
