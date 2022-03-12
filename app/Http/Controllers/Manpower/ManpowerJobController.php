<?php

namespace App\Http\Controllers\manpower;

use App\Models\Job;
use App\Models\ManpowerJob;
use Illuminate\Http\Request;
use App\Models\ManpowerOffice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManpowerJobController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        foreach($request->jobId as $idx => $jobId){
            $validate = DB::table('job_manpower_office')
                            ->where('manpower_office_id', $request->add_to_manpower_office_id)
                            ->where('job_id', $jobId)
                            ->get();
            if($validate->isEmpty()){
                DB::table('job_manpower_office')->insert([
                    'manpower_office_id' => $request->add_to_manpower_office_id,
                    'job_id' => $jobId,
                    'processing_cost' => $request->processingCost[$idx],
                    'manpower_office_id' => $request->add_to_manpower_office_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }else{
                DB::rollBack();
                echo json_encode(array('error' => true, 'error_number' => $idx));
                return;
            }
        }
        DB::commit();
        echo json_encode(array('error' => false));
        return;
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
    public function edit($id, Request $request)
    {
        $manpower_job = DB::table('job_manpower_office')->where('id', $id)->get()->first();
        $html = '';
        $jobs = Job::get();
        foreach($jobs as $job){
            if($job->id == $manpower_job->job_id){
                $html .= "<option value=\"{$job->id}\" selected> {$job->name} {$job->credit_type} </option>";
            }else{                
                $html .= "<option value=\"{$job->id}\"> {$job->name} {$job->credit_type} </option>";
            }
        }
        echo json_encode(array('jobs_option' => $html, 'processing_cost' => $manpower_job->processing_cost));
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
        DB::table('job_manpower_office')
            ->where('id', $id)
            ->update([
                'job_id' => $request->jobId,
                'processing_cost' => $request->processingCost,
            ]);

        echo json_encode(array('error' => false));

        alert($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('job_manpower_office')
            ->where('id', $id)
            ->delete();

        echo json_encode(array('error' => false));

        alert($request);
    }
}
