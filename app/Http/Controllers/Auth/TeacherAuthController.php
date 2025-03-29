<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('teacher')->check()) {
            return view('teacher.dashboard');
        }
        return view('auth.teacherLogin');
    }
    public function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('teacher')->user()->role != 'teacher') {
                Auth::guard('teacher')->logout();
                return redirect()->route('teacher.index')->with('error', 'Unauthorized Access Please Try...Another Account');
            }
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('teacher.index')->with('error', 'Unauthorized Access Please Try...Another Account');
        }
    }


    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function logout()
    {
        Auth::guard('tacher')->logout();
        Auth::logout();

        return redirect()->route('student.index');
    }
}
