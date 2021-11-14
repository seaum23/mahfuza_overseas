<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateUpdateController extends Controller
{
    public function test_medical(Request $request)
    {
        $candidate = Candidate::find($request->update_id);
        $candidate->test_medical_file = move($request->test_candidate_file, 'candidate', 'testMedicalFile_' . $candidate->id . '_' . time() );
        $candidate->test_medical_status = 1; // Fit
        $candidate->save();
    }

    public function final_medical(Request $request)
    {
        $candidate = Candidate::find($request->update_id_final);
        $candidate->final_medical_file = move($request->final_candidate_file, 'candidate', 'finalMedicalFile_' . $candidate->id . '_' . time() );
        $candidate->final_medical_status = 1; // Fit
        $candidate->final_medical_report = $request->final_date;
        
        $candidate->save();
    }

    public function police_clearance(Request $request)
    {
        $candidate = Candidate::find($request->update_id_police);
        $candidate->police_clearance_file = move($request->police_file, 'candidate', 'policeClearanceFile_' . $candidate->id . '_' . time() );
        
        $candidate->save();
    }
}
