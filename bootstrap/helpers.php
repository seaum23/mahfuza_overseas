<?php

use App\Models\TemporaryFile;

function alert($request, $message = 'Successfull!', $type = 'success')
{
    $request->session()->flash('alert', 'Yes');
    $request->session()->flash('message', $message);
    $request->session()->flash('alert_type', strtolower($type));
}

/**
 * Moves file from temporary folder. *
 * 
 * @author Samin Yeasar Seaum
 * @return String File Path
 * 
 */ 
function move(String $folder_name, String $storing_file_path, String $file_name)
{
    $agent_passport_temporary_file = TemporaryFile::where('folder', $folder_name)->first();
    $file_ext = explode('.', $agent_passport_temporary_file->file_name);
    $file_actual_path = storage_path('app/public/' . $storing_file_path . '/' . $file_name . '_' . time() . '.' . $file_ext[1]);
    rename(storage_path('app/uploads/tmp/' . $agent_passport_temporary_file->folder . '/' . $agent_passport_temporary_file->file_name), $file_actual_path);

    rmdir(storage_path('app/uploads/tmp/' . $agent_passport_temporary_file->folder));

    $agent_passport_temporary_file->delete();
    return 'storage/' . $storing_file_path. '/' . $file_name . '_' . time() . '.' . $file_ext[1];
}