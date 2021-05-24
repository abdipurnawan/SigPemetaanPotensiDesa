<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Access only on API
    public function register(Request $request)
    {
        $user = new Admin();
        $user->nama ->request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return 'sukses';
    }

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard()->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Email atau Password Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('home');
    }

    public function editprofile($id, Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $admin = Admin::find($id);
        $admin->username = $request->username;
        $admin->nama = $request->nama;
        $admin->update();
        return redirect()->back()->with('statusInput', 'Profile Berhasil di Update');
    }

    public function editpassword($id, Request $request){
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ],[
            'password_confirmation.same' => "Konfirmasi password baru tidak sesuai",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $admin = Admin::find($id);
        if (Hash::check($request->password_lama, $admin->password)) {
            Admin::where('id', $admin->id)->update([
                'password' => bcrypt($request->password)
            ]);
            //dd($admin->nama);
            return redirect()->back()->with('statusInput', 'Password Berhasil di Ubah');
        } else{
            //dd($admin->nama);
            return redirect()->back()->with('error', 'Password Gagal di Ubah');
        }
    }
}
