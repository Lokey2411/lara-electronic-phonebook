<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // route
    public function loginRoute()
    {
        return view("pages.auth.login");
    }
    //controller
    public function handleLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // $request->session()->put('user', $user);
        $user = User::where("username", $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->Password)) {
            return redirect(route("login"))->with("error", "Sai tên đăng nhập hoặc mật khẩu");
        } else {
            $request->session()->put('user', $user->employee);
            $request->session()->put('role', $user->Role);
            return redirect(route("home"));
        }
    }
    public function handleLogout(Request $request)
    {
        $request->session()->remove('user');
        return redirect(route("login"));
    }

}