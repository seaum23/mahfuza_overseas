<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('templates.login');
    }

    public function login(Request $request)
    {
        // dd($request->only('employee_id', 'password'));
        if(!auth()->attempt($request->only('employee_id', 'password'))){
            return back()->with('status', 'Invalid login information!');
        }

        return redirect()->route('dashboard');
    }
}
