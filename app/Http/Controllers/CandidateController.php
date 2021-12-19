<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Agent;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\ManpowerOffice;
use App\Models\Processing;
use App\Models\SponsorVisa;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.candidate.candidate_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::get();
        $manpower_offices = ManpowerOffice::get();
        $agents = Agent::get();
        $countries = DB::table('delegates')
                 ->select('country')
                 ->groupBy('country')
                 ->get();
        return view('templates.candidate.new_candidate', [
            'agents' => $agents,
            'manpower_offices' => $manpower_offices,
            'jobs' => $jobs,
            'countries' => $countries,
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
        $eighteen = new DateTime(date('Y-m-d'));
        $eighteen->sub(new DateInterval('P18Y'));
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|size:11',
            'date_of_birth' => 'required|before_or_equal:' . $eighteen->format('Y-m-d'),
            'passport_number' => 'required',
            'issu_date' => 'required',
            'agent' => 'required',
            'passport_scan' => 'required',
        ]);

        if($request->departureDate > $request->arrivalDate){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'departureDate' => ['Departure Date Must Be Smaller Than Arrival Date!'],
            ]);
            throw $error;
        }

        $exisitng = Candidate::where('passportNum', $request->passport_number)->get();
        if(!$exisitng->isEmpty()){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'passport_number' => ['Passport already exists!'],
            ]);
            throw $error;
        }

        $candidate = Candidate::create([
            'passportNum' => $request->passport_number,
            'fName' => $request->first_name,
            'lName' => $request->last_name,
            'phone' => $request->phone_number,
            'data_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'issue_date' => $request->issu_date,
            'validity' => $request->validityYear,
            'agent_id' => $request->agent,
            'experience_status' => $request->experience,
            'comment' => '',
            'country' => $request->country,
            'updated_by' => auth()->id(),
            'in_processing' => 0
        ]);

        if(!empty($request->expCountry)){
            foreach($request->expCountry as $country){
                $candidate->countries()->create([
                    'country' => $country
                ]);
            }
        }        

        if(!empty($request->departureDate)){
            $candidate->departure_date = $request->departureDate;
        }
        

        if(!empty($request->arrivalDate)){
            $candidate->arrival_date = $request->arrivalDate;
        }

        /**
         * Inserting all files
         */
        if(!empty($request->passport_scan)){
            $candidate->passport_scanned_copy = move($request->passport_scan, 'candidate', 'passport_scanned_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->policeVerification)){
            $candidate->police_clearance_file = move($request->policeVerification, 'candidate', 'police_clearance_file_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->photoFile)){
            $candidate->personal_photo_file = move($request->photoFile, 'candidate', 'personal_photo_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->trainingCard)){
            $candidate->training_card_file = move($request->trainingCard, 'candidate', 'training_card_' . $candidate->id . '_' . time() );
        }        

        if(!empty($request->departureSealFile)){
            $candidate->departureSealFile = move($request->departureSealFile, 'candidate', 'departureSealFile_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->arrivalSealFile)){
            $candidate->arrivalSealFile = move($request->arrivalSealFile, 'candidate', 'arrivalSealFile_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->optionalFile)){
            foreach($request->optionalFile as $file){
                $tmp = move($file, 'candidate', 'optional_file_' . $candidate->id . '_' . uniqid() . '_' . uniqid() );
                $candidate->experience_filse()->create([
                    'file_path' => $tmp
                ]);
            }
        }

        $candidate->save();

        alert($request);
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
    public function edit($id)
    {
        //
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
        //
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

    public function experienced($id)
    {
        $experience_info = Candidate::select('id', 'lName', 'fName', 'departureSealFile', 'arrivalSealFile', 'departure_date', 'arrival_date')->where('id', $id)->first();
        return view('templates.candidate.experienced_candidate_files', [
            'experience_info' => $experience_info
        ]);
    }

    public function sponsor_visa(Candidate $candidate)
    {
        $visas =  SponsorVisa::whereHas('sponsor.delegate_office.delegate', function ($query) use ($candidate)
        {
            $query->where('delegates.country', $candidate->country);
        })->with('sponsor.delegate_office.delegate', 'job')->get();
        
        foreach($visas as $visa){
            echo '<option value="'.$visa->id.'">'.$visa->sponsor->sponsor_name.' - '.$visa->job->name.' - '.$visa->sponsor->delegate_office->delegate->name.'</option>';
        }
    }

    public function sponsor_visa_insert(Request $request)
    {
        $candidate = Candidate::find($request->candidate_id);

        if(is_null($candidate)){
            return;
        }

        $sponsor_visa = SponsorVisa::find($request->sponsor_visa_id);

        if($sponsor_visa->visa_amount == 0){
            json_encode(array('error' => true, 'message' => 'Visa Amount Zero!'));
            return;
        }

        Processing::create([
            'candidate_id' => $request->candidate_id,
            'sponsor_visa_id' => $request->sponsor_visa_id,
            'updated_by' => auth()->id(),
        ]);

        $sponsor_visa->visa_amount = $sponsor_visa->visa_amount - 1;

        $candidate->in_processing = 1;
        $candidate->save();
        $sponsor_visa->save();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // <a href="'.asset($query->test_medical_file).'" target="_blank">
        //                             <button class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>
        //                         </a>
        if ($request->ajax()) {
            $query = Candidate::with('agent')->select('candidates.*')->orderBy('id', 'desc');
            
            return Datatables::of($query)
            ->editColumn('fName', function ($query)
            {
                $html = '<p> <span class="text-secondary">Name: </span>' . $query->fName . ' ' . $query->lName . '</p>';
                $html .= '<p> <span class="text-secondary">Agent: </span>' . $query->agent->full_name . '</p>';
                return $html;
            })
            ->editColumn('data_of_birth', function ($query)
            {
                return $query->age();
            })            
            ->addColumn('passport_expiry', function ($query) {
                return $query->passport_expiry();
            })
            ->editColumn('experience_status', function ($query)
            {
                if($query->experience_status == 1){
                    return 'New';
                }
                
                return $query->experience();
            }) 
            ->editColumn('test_medical_status', function ($query)
            {
                if($query->test_medical_status == 0){
                    return '<button onclick="update_test_medical('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#test_medical_modal" class="btn btn-xs btn-secondary">No</button>';
                }
                
                $html = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <button onclick="test_medical_file(\''.asset($query->test_medical_file).'\', \''.$query->id.'\')" data-target="#test_medical_file_show" data-toggle="modal" class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>';
                if($query->test_medical_status == 1){
                    $html .=    '<button class="btn btn-xs btn-success">Fit</button>';
                }
                if($query->test_medical_status == 2){
                    $html .=    '<button class="btn btn-xs btn-danger">Unfit</button>';
                }
                return $html.
                            '</div>
                        </div>';
            })
            ->editColumn('final_medical_status', function ($query)
            {
                if($query->final_medical_status == 0){
                    return '<button onclick="update_final_medical('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#final_medical_modal" class="btn btn-xs btn-secondary">No</button>';
                }
                
                $html = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button onclick="final_medical_file(\''.asset($query->final_medical_file).'\', \''.$query->id.'\')" data-target="#final_medical_file_show" data-toggle="modal"  class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>';
                if($query->final_medical_status == 1){
                    $html .=    '<button class="btn btn-xs btn-success">Fit</button>';
                }
                if($query->final_medical_status == 2){
                    $html .=    '<button class="btn btn-xs btn-danger">Unfit</button>';
                }
                // '<badge></bdag>'
                return $html.
                            '</div>
                        </div>';
            })
            ->editColumn('police_clearance_file', function ($query)
            {
                if(empty($query->police_clearance_file)){
                    return '<button onclick="update_police_clearance('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#police_clearance_modal" class="btn btn-xs btn-secondary">No</button>';
                }
                
                $html = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button onclick="police_clearance_file(\''.asset($query->police_clearance_file).'\', \''.$query->id.'\')" data-target="#police_clearance_file_show" data-toggle="modal"  class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>
                            </div>';
                return $html .
                        '</div>';
            })
            ->editColumn('training_card_file', function ($query)
            {
                if($query->experience_status == 2){
                    return '<a href="'.url('/candidate/experienced/' . $query->id).'"><button class="btn btn-xs btn-info">Experienced</button></a>';
                }

                if($query->experience_status == 1 AND empty($query->training_card_file)){
                    return '<button onclick="update_training_card('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#traning_card_modal" class="btn btn-xs btn-secondary">No</button>';
                }
                
                $html = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button onclick="training_card_file(\''.asset($query->training_card_file).'\', \''.$query->id.'\')" data-target="#training_card_file_show" data-toggle="modal"  class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>
                            </div>';
                return $html .
                        '</div>';
            })
            ->addColumn('action', function ($query) {
                $html = '<div class="btn-group">';
                if(is_null($query->job_id)){
                    $html .= '<button onclick="assign_job('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#assign_job_modal" class="btn btn-warning btn-xs">Job</button>';
                }
                if($query->in_processing == 0){
                    $html .= '<button onclick="assign_visa('.$query->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#sponsor_visa_modal" class="btn btn-info btn-xs">Visa</button>';
                }
                return $html . "</div>" ;
            })
            ->rawColumns(['action', 'fName', 'test_medical_status', 'final_medical_status', 'police_clearance_file', 'training_card_file'])
            ->make(true);
        }
    }
}
