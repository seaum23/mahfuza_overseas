<?php

namespace App\Http\Controllers\Manpower;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManpowerOffice;

class ManpowerOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = ManpowerOffice::with('manpower_job')->paginate(10);
        return view('templates.manpower.manpower_office_list', [
            'offices' => $offices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::get();
        return view('templates.manpower.manpower_office', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manpower_office = ManpowerOffice::create([
            'name' => $request->officeName,
            'license' => $request->licenseNumber,
            'address' => $request->officeAddress,
            'comment' => $request->comment,
            'updated_by' => auth()->id(),
        ]);
        foreach($request->jobId as $idx=>$job){
            $manpower_office->manpower_job()->updateOrCreate(
                ['job_id' => $job],
                ['processing_cost' => $request->processingCost[$idx]
            ]);
        }
        $request->session()->flash('alert', 'Yes');
        $request->session()->flash('message', 'Task was successful!');
        $request->session()->flash('alert_type', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ManpowerOffice $manpower_office)
    {
        return json_encode($manpower_office);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manpower_office = ManpowerOffice::find($id);
        
        $manpower_office->name = $request->officeName;
        $manpower_office->license = $request->licenseNumber;
        $manpower_office->address = $request->officeAddress;
        $manpower_office->comment = $request->comment;
        $manpower_office->updated_by = auth()->id();
        $manpower_office->save();

        alert($request, 'Success!', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * AJAX reuest data
     */

    public function fetch_form_element(Request $request)
    {        
        $html = '<div class="row jod-extra-body">
                    <div class="col-sm">                        
                        <label>Job</label>';
                        
        if(isset($request->number_of_jobs)){
            $html .= '<div id="jobId_div_'.$request->number_of_jobs.'">';
        }else{
            $html .= '<div>';
        }                        
        $html .= '<select class="form-control select2" name="jobId[]" required>
                    <option value="">Select Job</option>';
        $jobs = Job::get();
        foreach($jobs as $job){
            $html .= '<option value="'.$job->id.'"> '.$job->name.' - '.$job->credit_type.' </option>';
        }
        $html .=    '</select>
        </div>
                    </div>
                    <div class="col-sm">
                        <label>Processing Cost</label>
                        <input class="form-control" autocomplete="off" type="number" name="processingCost[]" placeholder="Cost" required>
                    </div>
                </div>';
        echo json_encode(array('html' => $html));
    }
}
