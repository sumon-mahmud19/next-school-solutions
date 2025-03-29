<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.dashboard');
        }
        return view('auth.adminLogin');
    }
    public function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.index')->with('error', 'Unauthorized Access Please Try...Another Account');
            }
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.index')->with('error', 'Unauthorized Access Please Try...Another Account');
        }
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::logout();

        return redirect()->route('admin.index');
    }
}
