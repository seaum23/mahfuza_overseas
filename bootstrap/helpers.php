<?php

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

function alert($request, $message = 'Successfull!', $type = 'success')
{
    $request->session()->flash('alert', 'Yes');
    $request->session()->flash('message', $message);
    $request->session()->flash('alert_type', strtolower($type));
}

function move(String $folder_name, String $storing_file_path, String $file_name)
{
    $agent_passport_temporary_file = TemporaryFile::where('folder', substr($folder_name, 0, 27))->first();
    $file_ext = explode('.', $agent_passport_temporary_file->file_name);
    $file_actual_path = storage_path($storing_file_path . $file_name . '.' . $file_ext[1]);
    rename(storage_path('app/uploads/tmp/' . $agent_passport_temporary_file->folder . '/' . $agent_passport_temporary_file->file_name), $file_actual_path);

    rmdir(storage_path('app/uploads/tmp/' . $agent_passport_temporary_file->folder));

    $agent_passport_temporary_file->delete();
    return $file_actual_path;
}