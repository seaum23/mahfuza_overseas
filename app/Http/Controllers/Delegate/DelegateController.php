<?php

namespace App\Http\Controllers\Delegate;

use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DelegateOffice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DelegateController extends Controller
{
    public function index()
    {
        return view('templates.delegate.new_delegate');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'delegateName' => 'required',
            'delegateCountry' => 'required',
            'delegateState' => 'required',
            'delegateOffice' => 'required',
            'licenseNumber' => 'required',
        ]);

        $offices = explode(',', $request->delegateOffice);
        $licenseNumbers = explode(',', $request->licenseNumber);
        if(count($offices) != count($licenseNumbers)){
            throw ValidationException::withMessages(['numbers' => 'Office and Lincense numbers did not match!']);
        }

        $delegate = new Delegate;

        $delegate->name = $request->delegateName;
        $delegate->country = $request->delegateCountry;
        $delegate->state = $request->delegateState;
        $delegate->comment = $request->comment;
        $delegate->updated_by = auth()->id();

        $delegate->save();

        foreach($offices as $idx=>$office){
            $delegate->delegate_offices()->create([
                'name' => $office,
                'license_number' => $licenseNumbers[$idx],
            ]);
        }

    }

    public function show()
    {
        $delegates = Delegate::paginate(10);
        return view('templates.delegate.delegate_list', [
            'delegates' => $delegates
        ]);
    }
}
