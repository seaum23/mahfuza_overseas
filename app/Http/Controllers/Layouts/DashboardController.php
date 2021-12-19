<?php

namespace App\Http\Controllers\Layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        return view('templates.dashboard');
    }
    public function FunctionName(Type $var = null)
    {
        # code..
    }
}
