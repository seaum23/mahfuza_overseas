<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Agent;
use App\Models\Account;
use App\Models\Candidate;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Models\ManpowerOffice;

class FormTemplateController extends Controller
{
    public function visa_form_template($index)
    {
        return view('form_templates.visa-form-template', [
            'index' => $index
        ]);
    }
    public function candidate_experience_tempalte($status)
    {
        /**
         * 
         * 1 => New Candidate
         * 2 => Experienced Candidate
         * 
         */
        if($status == '1'){
            return view('form_templates.no_experience_candidate');
        }else{
            return view('form_templates.experienced_candidate');
        }
    }

    public function get_manpower_office(Job $job)
    {
        $manpowers = $job->manpower_offices;
        echo json_encode(array(
            'manpower' => view('form_templates.manpower_office_selections', [ 'manpowers' => $manpowers ])->render(),
            'transaction_amount' => view('form_templates.agent_comission_visa_fee', [ 'credit_type' => $job->credit_type ])->render(),
            'agent_expense' => 'test',
        ));
    }

    public function sponsor_office($idx)
    {
        return view('form_templates.sponsor_visa_form', [
            'idx' => $idx
        ]);
    }

    public function transaction_template(Request $request)
    {
        $candidates = NULL;
        switch($request->type){
            case 'agent':
                $particular = Agent::find($request->id);
                $type = '<option value="agent" selected>Agent</option>';
                $particular = '<option value="'.$particular->id.'">'.$particular->full_name.'</option>';
                $candidates = Candidate::select('id', 'fName', 'lName')->whereHas('processings', function ($query){
                    $query->whereIn('pending', [0, 1]);
                })->get();
                break;
            case 'delegate':
                $particular = Delegate::find($request->id);
                $type = '<option value="delegate" selected>Delegate</option>';
                $particular = '<option value="'.$particular->id.'">'.$particular->name.'</option>';
                break;
            case 'manpower':
                $particular = ManpowerOffice::find($request->id);
                $type = '<option value="manpower" selected>Manpower</option>';
                $particular = '<option value="'.$particular->id.'">'.$particular->name.'</option>';
                break;
            default:
                $type = "";
                $particular = "";
                break;
        }
        $accounts = Account::where('payment_account', 0)->get();
        $payment_accounts = Account::where('payment_account', 1)->get();
        return view('components.transaction-full-form-specified', [
            'type' => $type,
            'particular' => $particular,
            'accounts' => $accounts,
            'payment_accounts' => $payment_accounts,
            'candidates' => $candidates
        ]);
    }

    public function sponsor_parent_type(Request $request)
    {
        if($request->type == 'Agent'){
            return view('form_templates.agent_sponsor_parent', [
                'agents' => Agent::get()
            ]);
        }

        if($request->type == 'Delegate'){
            return view('form_templates.delegate_sponsor_parent', [
                'delegates' => Delegate::get()
            ]);
        }

    }

    public function visa_to_sponsor()
    {
        return view('form_templates.visa-to-sponsor', [
            'jobs' => Job::get()
        ])->render();
    }

    public function candidate_to_sponsor_visa(Request $request)
    {
        return view('form_templates.candidate-to-sponsor-visa', [
            'candidates' => Candidate::where('gender', $request->gender)
                            ->where('job_id', $request->job_type)
                            ->where('final_medical_status', 1)
                            ->where('test_medical_status', 1)
                            ->get()
        ])->render();
    }
}
