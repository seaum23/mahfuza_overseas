<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormTemplateController extends Controller
{
    public function visa_form_template($index)
    {
        return view('form_templates.visa-form-template', [
            'index' => $index
        ]);
    }
}
