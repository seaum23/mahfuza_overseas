<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Candidate;
use App\Models\District;
use App\Models\Division;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CandidateUpdateController extends Controller
{
    public function fit_unfit(Candidate $candidate, Request $request)
    {
        if($request->fittness == 'fit'){
            if($request->medical == 'final_medical'){
                $candidate->final_medical_status = '2';
            }else{
                $candidate->test_medical_status = '2';
            }
        }else{
            if($request->medical == 'final_medical'){
                $candidate->final_medical_status = '3';
            }else{
                $candidate->test_medical_status = '3';
            }
        }

        $candidate->save();
    }

    public function test_medical(Request $request)
    {
        $candidate = Candidate::with('agent')->find($request->update_id);
        $candidate->test_medical_file = move($request->test_candidate_file, 'candidate', 'testMedicalFile_' . $candidate->id . '_' . time() );
        $candidate->test_medical_status = 1; // Pending Fittness

        if($request->test_medical_amount > 0){
            transaction($request->test_medical_amount, $candidate->agent->id, $candidate->id, $request->test_medical_amount_payment_account);
        }

        $candidate->save();
    }

    public function final_medical(Request $request)
    {
        $candidate = Candidate::with('agent')->find($request->update_id_final);
        $candidate->final_medical_file = move($request->final_candidate_file, 'candidate', 'finalMedicalFile_' . $candidate->id . '_' . time() );
        $candidate->final_medical_status = 1; // Pending Fittness
        $candidate->final_medical_report = $request->final_date;

        if($request->final_medical_amount > 0){
            transaction($request->final_medical_amount, $candidate->agent->id, $candidate->id, $request->final_medical_amount_payment_account);
        }
        
        $candidate->save();
    }

    public function police_clearance(Request $request)
    {
        $candidate = Candidate::with('agent')->find($request->update_id_police);
        $candidate->police_clearance_file = move($request->police_file, 'candidate', 'policeClearanceFile_' . $candidate->id . '_' . time() );
        
        if($request->police_clearance_amount > 0){
            transaction($request->police_clearance_amount, $candidate->agent->id, $candidate->id, $request->police_clearance_amount_payment_account);
        }

        $candidate->save();
    }

    public function arrival_seal(Request $request, Candidate $candidate)
    {
        if(!empty($request->arrivalSealFile)){
            $candidate->arrivalSealFile = move($request->arrivalSealFile, 'candidate', 'arrivalSealFile_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->arrival_date_update)){
            $candidate->arrival_date = $request->arrival_date_update;
        }
        
        $candidate->save();
    
        return back();
    }

    public function departure_seal(Request $request, Candidate $candidate)
    {
        if(!empty($request->departureSealFile)){
            $candidate->departureSealFile = move($request->departureSealFile, 'candidate', 'departureSealFile_' . $candidate->id . '_' . time() );
        }

        if(!empty($request->departure_date_update)){
            $candidate->departure_date = $request->departure_date_update;
        }

        $candidate->save();

        return back();
    }

    public function training_card(Request $request)
    {
        $candidate = Candidate::with('agent')->find($request->update_id_training);
        $candidate->training_card_file = move($request->training_file, 'candidate', 'trainingCard_' . $candidate->id . '_' . time() );
        
        if($request->training_card_amount > 0){
            transaction($request->training_card_amount, $candidate->agent->id, $candidate->id, $request->training_card_amount_payment_account);
        }

        $candidate->save();
    }

    public function update_job(Request $request)
    {
        $candidate = Candidate::with('agent')->find($request->update_job_candidate_id);
        $candidate->job_id = $request->job_type;
        $candidate->manpower_office_id = $request->manpower;
        if($request->payment_type == 'Comission'){
            $candidate->agent_comission = $request->amount;
        }else{
            $transaction = new Transaction();
            $transaction->quantity = 1;
            $transaction->currency = 'bdt';
            $transaction->unit_price = $request->amount;
            $transaction->exchange_rate = 1;
            $transaction->particular_type = Agent::class;
            $transaction->particular_id = $candidate->agent->id;
            $transaction->candidate_id = $candidate->id;
            $transaction->purpose = 'VISA Fee';
            $transaction->save();
            $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
            $transaction->save();

            $transaction->debits()->create([
                'amount' => $request->amount,
                'account_id' => '1',
            ]);

            $transaction->credits()->create([
                'amount' => $request->amount,
                'account_id' => 8,
            ]);
        }
        $candidate->save();
    }

    public function assign_country(Request $request)
    {
        $candidate = Candidate::find($request->update_country_id);
        $candidate->in_processing = 1;
        $candidate->country = $request->update_country;
        $candidate->save();
    }

    public function send_to_manpower(Request $request)
    {
        $request->validate([
            'manpower_status_file' => 'required'
        ]);
        $candidate = Candidate::find($request->manpower_status_update);
        $candidate->manpower_status = 1;
        $candidate->manpower_status_file = move($request->manpower_status_file, 'candidate', 'manpower_sent_receipt_' . $candidate->id . '_' . time() );
        $candidate->save();
    }

    public function add_youtube_link(Request $request)
    {
        // $request->validate([
        //     'manpower_status_file' => 'required'
        // ]);
        $candidate = Candidate::find($request->youtube_link_update);
        $candidate->youtube_link = $request->youtube_link;
        $candidate->save();
    }

    public function candidate_division($district)
    {
        $district = District::with('division')->where('name', $district)->first();

        echo (is_null($district)) ? '' : $district->division->name;
    }
    
}
