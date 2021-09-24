<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DelegateOffice;
use App\Models\Sponsor;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;
// use Datatables;

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

    public function edit_sponsor_data(Request $request)
    {
        $delegate_offices = DelegateOffice::get();
        $delegate_office_response = '';
        foreach($delegate_offices as $delegate_office){
            $delegate_office_response .= '<option value="'.$delegate_office->id.'" '.($delegate_office->id == $request->delegate_office ? "selected" : "").' >'.$delegate_office->name.'</option>';
        }
        $delegates = Delegate::get();
        $delegate_response = '';
        foreach($delegates as $delegate){
            $delegate_response .= '<option value="'.$delegate->id.'" '.($delegate->id == $request->delegate ? "selected" : "").' >'.$delegate->name.'</option>';
        }
        echo json_encode(array(
            'delegate_offices' => $delegate_office_response,
            'delegates' => $delegate_response,
        ));
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('templates.sponsor.sponsor_list');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table_data(Request $request)
    {
        if ($request->ajax()) {
            $query = Sponsor::with('delegate_office.delegate')->select('sponsors.*');
            
            return Datatables::of($query)            
            ->editColumn('delegate_office.name', function ($request)
            {
                return $request->delegate_office->delegate->name . ' - ' . $request->delegate_office->name;
            })
            ->addColumn('action', function ($query) {
                return '<button data-toggle="modal" data-target="#update_sponsor_modal" class="btn btn-sm btn-primary" onclick="edit_sponsor('.$query->id.', '.$query->delegate_office->id.', '.$query->delegate_office->delegate->id.', \''.$query->sponsor_name.'\', \''.$query->sponsor_NID.'\', \''.$query->sponsor_phone.'\', \''.$query->comment.'\')"><i class="fas fa-edit"></i> Edit</button>';
            })
            ->make(true);
        }
    }

    public function update(Sponsor $sponsor, Request $request)
    {
        if($sponsor_id->sponsor_NID != $request->sponsorNid AND Sponsor::where('sponsor_NID', $request->sponsorNid)->first()){
            echo json_encode(array('sponsorNid' => 'Sponsor already exists!', 'error' => true));
            return;
        }

        $sponsor->sponsor_NID = $request->sponsorNid;
        $sponsor->sponsor_name = $request->sponsorName;
        $sponsor->sponsor_phone = $request->sponsorPhone;
        $sponsor->comment = $request->comment;
        $sponsor->delegate_office_id = $request->delegateOfficeId;
        $sponsor->updated_by = auth()->id();
        
        $sponsor->save();
        echo json_encode(array('sponsorNid' => 'Success!', 'error' => false));
    }
}
