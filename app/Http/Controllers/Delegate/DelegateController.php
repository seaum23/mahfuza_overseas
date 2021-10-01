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

    public function update(Request $request, Delegate $delegate)
    {
        $delegate->name = $request->delegateName;
        $delegate->country = $request->delegateCountry;
        $delegate->state = $request->delegateState;
        $delegate->comment = $request->comment;
        $delegate->save();

        $error = false;
        $message = 'Successfull!';
        $info = array(
            'error' => $error,
            'message' => $message,
        );
        echo json_encode($info);
        return;
    }

    public function store_new_office(Request $request, Delegate $delegate)
    {
        $offices = explode(',', $request->delegateOffice);
        $licenseNumbers = explode(',', $request->licenseNumber);
        $error = false;
        $message = '';
        if(count($offices) != count($licenseNumbers)){
            $error = true;
            $message = 'Office and License Number mismatch!';
            $info = array(
                'error' => $error,
                'message' => $message,
            );
            echo json_encode($info);
            return;
        }

        foreach($offices as $idx=>$office){
            $delegate->delegate_offices()->create([
                'name' => $office,
                'license_number' => $licenseNumbers[$idx],
                'updated_by' => auth()->id(),
            ]);
        }
        $message = 'Successfully Done!';
        $info = array(
            'error' => $error,
            'message' => $message,
        );
        echo json_encode($info);
        return;
    }

    public function destroy_office(DelegateOffice $delegate_office)
    {   
        $error = false;
        $message = 'Successfull!';
        $delegate_office->delete();
        $info = array(
            'error' => $error,
            'message' => $message,
        );
        echo json_encode($info);
        return;
    }

    public function update_office(Request $request, DelegateOffice $delegate_office)
    {   
        $delegate_office->name = $request->office_name;
        $delegate_office->license_number = $request->license_number;
        $delegate_office->updated_by = auth()->id();
        $delegate_office->save();

        $error = false;
        $message = 'Successfull!';
        $info = array(
            'error' => $error,
            'message' => $message,
        );
        echo json_encode($info);
        return;
    }

    public function list()
    {
        $delegates = Delegate::with('delegate_offices')->paginate(10);
        return view('templates.delegate.delegate_list', [
            'delegates' => $delegates
        ]);
    }
}