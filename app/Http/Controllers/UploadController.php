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
        }else if($request->hasFile('agentPassport')){
            $file = $request->file('agentPassport');
            $tmp = $this->upload($file);
            return $tmp;
        }else if($request->hasFile('agentPolice')){
            $file = $request->file('agentPolice');
            $tmp = $this->upload($file);
            return $tmp;
        }
        return '';
    }

    public function delete(Request $request)
    {
        $fileId = substr(request()->getContent(), 0, 27);
        File::deleteDirectory(storage_path('app/uploads/tmp/' . $fileId));
    }

    public function upload($file)
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
