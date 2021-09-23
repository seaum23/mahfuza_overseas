<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DelegateOffice;
use App\Models\Sponsor;
use Illuminate\Validation\ValidationException;

class SponsorController extends Controller
{
    public function index()
    {
        $delegates = Delegate::get();
        return view('templates.sponsor.new_sponsor', [
            'delegates' => $delegates
        ]);
    }

    public function fetch_delegate_office(Delegate $delegate)
    {
        echo json_encode($delegate->delegate_offices);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'delegateId' => 'required',
            'delegateOfficeId' => 'required',
            'sponsorName' => 'required',
            'sponsorNid' => 'required',
            'sponsorPhone' => 'required',
        ]);

        if(Sponsor::where('sponsor_NID', $request->sponsorNid)->first()){
            throw ValidationException::withMessages(['sponsorNid' => 'Sponsor already exists!']);
        }

        $delegate_office = DelegateOffice::find($request->delegateOfficeId);
        $delegate_office->sponsor()->create([
            'sponsor_NID' => $request->sponsorNid,
            'sponsor_name' => $request->sponsorName,
            'sponsor_phone' => $request->sponsorPhone,
            'comment' => $request->comment,
            'updated_by' => auth()->id(),
        ]);

        $request->session()->flash('alert', 'Yes');
        $request->session()->flash('message', 'Task was successful!');
        $request->session()->flash('alert_type', 'success');
        return back();
    }
}
