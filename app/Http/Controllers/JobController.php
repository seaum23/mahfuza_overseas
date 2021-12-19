<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::paginate(10);
        return view('templates.jobs', [
            'jobs' => $jobs
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'job_name' => 'required',
            'job_type' => 'required',
        ]);
        if(Job::where([
            'name' => $request->job_name,
            'credit_type' => $request->job_type,
        ])->first()){
            throw ValidationException::withMessages(['error' => 'Job with this name and type already exits!']);
        }

        $job = new Job();
        $job->name = $request->job_name;
        $job->credit_type = $request->job_type;
        $job->updated_by = auth()->id();
        $job->save();

        return back();
    }

    public function update(Job $job, Request $request)
    {
        if($job->name != $request->job_name OR $job->credit_type != $request->job_type){
            if(Job::where([
                'name' => $request->job_name,
                'credit_type' => $request->job_type,
            ])->first()){
                throw ValidationException::withMessages([
                    'error' => 'Job with this name and type already exits!',
                    'update' => 'yes',
                    'job_id' => $job->id,
                ]);
            }
        }

        $job->name = $request->job_name;
        $job->credit_type = $request->job_type;
        $job->save();

        return back();        
    }
}
