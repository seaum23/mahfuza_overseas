<?php

namespace App\Http\Controllers\Layouts;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Processing;

class DashboardController extends Controller
{
    
    public function index()
    {
        $today = now();
        return view('templates.dashboard', [
            'flight_count' => Ticket::whereDate('flight_time', '=', $today->format('Y-m-d'))->count(),
            'success' => Processing::where('pending', '=', 3)->count(),
        ]);
    }
}
