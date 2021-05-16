<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = Admin::get();
        return view('admin.admin.admin', compact('admin'));
    }
    // Access only on API
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3',
            'password' => 'required|min:5',
            'repeat_password' => 'required|min:5|same:password',
            'nama' => 'required|min:5',
            'role' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $user = new Admin();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('admin/admins')->with('statusInput', 'Admin Berhasil Ditambahkan');
    }

    public function destroy($id){
        $admin = Admin::find($id);
        $admin->delete();
        return redirect('admin/desa')->with('statusInput', 'Admin Berhasil Dihapus');
    }

    public function role($id, $role)
    {
        $admin = Admin::find($id);
        $admin->role = $role;
        $admin->update();
        return response()->json(['success' => 'berhasil terganti']);
    }
}
