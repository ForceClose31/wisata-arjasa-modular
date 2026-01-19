<?php

namespace Modules\Core\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('core::auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->except('password'));
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();

            $request->session()->flash('nama_login', $user->email);
            $request->session()->flash('alert_tampil', true);

            return redirect()->intended('admin/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau password tidak terdaftar.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
