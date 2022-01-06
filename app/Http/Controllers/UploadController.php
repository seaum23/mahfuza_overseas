<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function agent_photo(Request $request)
    {
        if ($request->hasFile('agentImage')){
            $file = $request->file('agentImage');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('agentPassport')){
            $file = $request->file('agentPassport');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('agentPolice')){
            $file = $request->file('agentPolice');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('balanceSheet')){
            $file = $request->file('balanceSheet');
            $tmp = $this->upload($file);
            return $tmp;
        }        

        return '';
    }

    public function candidate_photo(Request $request)
    {
        if ($request->hasFile('passport_scan')){
            $file = $request->file('passport_scan');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('policeVerification')){
            $file = $request->file('policeVerification');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('photoFile')){
            $file = $request->file('photoFile');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('trainingCard')){
            $file = $request->file('trainingCard');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('optionalFile')){
            $file = $request->file('optionalFile')[0];
            $tmp = $this->upload($file);
            return $tmp;
        }        

        if($request->hasFile('departureSealFile')){
            $file = $request->file('departureSealFile');
            $tmp = $this->upload($file);
            return $tmp;
        }        

        if($request->hasFile('arrivalSealFile')){
            $file = $request->file('arrivalSealFile');
            $tmp = $this->upload($file);
            return $tmp;
        }                

        if($request->hasFile('test_candidate_file')){
            $file = $request->file('test_candidate_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                

        if($request->hasFile('update_test_candidate_file')){
            $file = $request->file('update_test_candidate_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                

        if($request->hasFile('final_candidate_file')){
            $file = $request->file('final_candidate_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                

        if($request->hasFile('update_final_candidate_file')){
            $file = $request->file('update_final_candidate_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                

        if($request->hasFile('police_file')){
            $file = $request->file('police_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                        

        if($request->hasFile('update_police_clearance_file')){
            $file = $request->file('update_police_clearance_file');
            $tmp = $this->upload($file);
            return $tmp;
        }                        

        if($request->hasFile('training_file')){
            $file = $request->file('training_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('update_training_card_file')){
            $file = $request->file('update_training_card_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('manpower_status_file')){
            $file = $request->file('manpower_status_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        return '';
    }

    public function processing_photo(Request $request)
    {
        if ($request->hasFile('okala_file')){
            $file = $request->file('okala_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if ($request->hasFile('mufa_file')){
            $file = $request->file('mufa_file');
            $tmp = $this->upload($file);
            return $tmp;
        }        

        if($request->hasFile('visa_stamping_file')){
            $file = $request->file('visa_stamping_file')[0];
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('training_file')){
            $file = $request->file('training_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('manpower_card_file')){
            $file = $request->file('manpower_card_file');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('ticketCopy')){
            $file = $request->file('ticketCopy');
            $tmp = $this->upload($file);
            return $tmp;
        }

        return '';
    }

    public function delegate_files(Request $request)
    {
        if($request->hasFile('balanceSheet')){
            $file = $request->file('balanceSheet');
            $tmp = $this->upload($file);
            return $tmp;
        }
    }

    public function manpower_files(Request $request)
    {
        if($request->hasFile('balanceSheet')){
            $file = $request->file('balanceSheet');
            $tmp = $this->upload($file);
            return $tmp;
        }

        if($request->hasFile('office_pad')){
            $file = $request->file('office_pad');
            $tmp = $this->upload($file);
            return $tmp;
        }
        
    }

    public function delete(Request $request)
    {
        $fileId = substr(request()->getContent(), 0, 27);
        File::deleteDirectory(storage_path('app/uploads/tmp/' . $fileId));
        TemporaryFile::where('folder', $fileId)->delete();
    }

    protected function upload($file)
    {
        $file_name = $file->getClientOriginalName();
        $folder = uniqid() . '-' . uniqid();
        $file->storeAs('uploads/tmp/' . $folder, $file_name);
        TemporaryFile::create([
            'folder' => $folder,
            'file_name' => $file_name,
        ]);
        return $folder;
    }    
}
