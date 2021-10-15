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
        if($status == 'new'){
            return view('form_templates.no_experience_candidate');
        }else{
            return view('form_templates.experienced_candidate');
        }
    }

    public function get_manpower_office(Job $job)
    {
        dd($job->manpower_offices());
        $manpowers = $job->manpower_offices;
        return view('form_templates.manpower_office_selections', [
            'manpowers' => $manpowers
        ]);
    }
}
