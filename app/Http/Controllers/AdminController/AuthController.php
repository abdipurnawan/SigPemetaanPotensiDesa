<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AuthController extends Controller
{
    // Access only on API
    public function register(Request $request)
    {
        $user = new Admin();
        $user->nama ->request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
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
            return redirect()->route('Dashboard');
        } else {
            return redirect()->back()->with('message', 'Email atau Password Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('Login Form');
    }
}
