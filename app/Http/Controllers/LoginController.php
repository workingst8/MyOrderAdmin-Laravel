<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('item.all');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('login_id', '=', $request->login_id)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect()->route('item.all');
            } else {
                return redirect()->route('login-form')->withErrors(['password' => '비밀번호가 틀립니다.']);
            }
        }
        return redirect()->route('login-form')->withErrors(['login_id' => '일치하는 계정 정보가 없습니다.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login-form');
    }
}
