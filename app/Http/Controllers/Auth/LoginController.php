<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Ticket;
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
        if(!auth()->attempt($request->only('employee_id', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login information!');
        }

        $today = now();
        return redirect()->route('dashboard', [
            'flight_count' => Ticket::whereDate('flight_time', '=', $today->format('Y-m-d'))
        ]);
    }
}
