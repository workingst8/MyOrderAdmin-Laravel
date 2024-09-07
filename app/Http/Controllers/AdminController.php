<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('pw_change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => '현재 비밀번호가 틀렸습니다.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        Auth::guard('admin')->logout();

        return redirect()->route('login-form')->with('status', '비밀번호가 성공적으로 변경되었습니다.');
    }
}
