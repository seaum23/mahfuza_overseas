<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\Job;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SponsorVisa;
use Validator;

class SponsorVisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sponsors = Sponsor::get();
        $jobs = Job::get();
        return view('templates.sponsor.new_sponsor_visa', [
            'sponsors' => $sponsors,
            'jobs' => $jobs,
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
        // dd($request->sponsorNid);
        $sponsor = Sponsor::find($request->sponsorNid);
        foreach($request->visaNo as $idx=>$visa_no){
            $sponsor->visa()->create([
                'sponsor_visa' => $visa_no,
                'issue_date' => $request->issueDate[$idx],
                'visa_amount' => $request->visaAmount[$idx],
                'visa_gender_type' => $request->gender[$idx],
                'job_id' => $request->job_name,
                'comment' => $request->comment,
                'country' => $request->country[$idx],
                'updated_by' => auth()->id(),
            ]);
        }
        return back();
    }

    /**
     * Display all resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $sponsor_visas = SponsorVisa::with('sponsor', 'job')->paginate(10);
        return view('templates.sponsor.sponsor_visa_list', [
            'sponsor_visas' => $sponsor_visas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SponsorVisa $sponsor_visa)
    {
        $sponsors = Sponsor::get();
        $sponsor_html = '';
        foreach($sponsors as $sponsor){
            if($sponsor_visa->sponsor_id == $sponsor->id){
                $sponsor_html .= '<option value="'.$sponsor->id.'" selected>' . $sponsor->sponsor_name . '</option>';
            }else{
                $sponsor_html .= '<option value="'.$sponsor->id.'">' . $sponsor->sponsor_name . '</option>';
            }
        }

        $jobs = Job::get();
        $jobs_html = '';
        foreach($jobs as $job){
            if($sponsor_visa->job_id == $job->id){
                $jobs_html .= '<option value="'.$job->id.'" selected>' . $job->name . '</option>';
            }else{
                $jobs_html .= '<option value="'.$job->id.'">' . $job->name . '</option>';
            }
        }
        return json_encode(array('sponsor_html' => $sponsor_html, 'job_html' => $jobs_html, 'sponsor_visa' => $sponsor_visa, 'country' => $sponsor_visa->country));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SponsorVisa $sponsor_visa)
    {
        
        $sponsor_visa->sponsor_id = $request->sponsorNid;
        $sponsor_visa->sponsor_visa = $request->visaNo;
        $sponsor_visa->sponsor_visa = $request->visaNo;
        $sponsor_visa->issue_date = $request->issueDate;
        $sponsor_visa->visa_amount = $request->visaAmount;
        $sponsor_visa->visa_gender_type = $request->gender;
        $sponsor_visa->job_id = $request->job_name;
        $sponsor_visa->comment = $request->comment;
        $sponsor_visa->updated_by = auth()->id();
        $sponsor_visa->country = $request->country;

        $sponsor_visa->save();

        return back();
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
}
