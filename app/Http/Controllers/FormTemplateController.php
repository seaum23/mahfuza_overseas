<?php

namespace App\Http\Controllers;

use App\Models\Job;
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
        return view('form_templates.manpower_office_selections', [
            'manpowers' => $manpowers
        ]);
    }

    public function sponsor_office($idx)
    {
        return view('form_templates.sponsor_visa_form', [
            'idx' => $idx
        ]);
    }
}
