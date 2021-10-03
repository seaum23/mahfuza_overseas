<?php

use Illuminate\Http\Request;

function alert($request, $message = 'Successfull!', $type = 'success')
{
    $request->session()->flash('alert', 'Yes');
    $request->session()->flash('message', $message);
    $request->session()->flash('alert_type', strtolower($type));
}