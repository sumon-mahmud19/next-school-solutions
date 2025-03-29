<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('student')->check()) {
            return view('student.dashboard');
        }
        return view('auth.studentLogin');
    }
    public function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('student')->user()->role != 'student') {
                Auth::guard('student')->logout();
                return redirect()->route('student.index')->with('error', 'Unauthorized Access Please Try...Another Account');
            }
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('student.index')->with('error', 'Unauthorized Access Please Try...Another Account');
        }
    }


    public function dashboard()
    {
        return view('student.dashboard');
    }


    public function logout()
    {
        Auth::guard('student')->logout();
        Auth::logout();

        return redirect()->route('student.index');
    }
}
