<?php

use App\Models\Agent;
use App\Models\Transaction;
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

/**
 * Transaction
 * 
 * @author Samin Yeasar Seaum
 * @return String Transaction ID
 * 
 */ 
function transaction($amount, $agent_id, $candidate_id, $payment_account)
{
    $transaction = new Transaction();
    $transaction->quantity = 1;
    $transaction->currency = 'bdt';
    $transaction->unit_price = $amount;
    $transaction->exchange_rate = 1;
    $transaction->particular_type = Agent::class;
    $transaction->particular_id = $agent_id;
    $transaction->candidate_id = $candidate_id;
    $transaction->purpose = 'Test Medical';
    $transaction->save();
    $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
    $transaction->save();

    $transaction->debits()->create([
        'amount' => $amount,
        'account_id' => '2',
    ]);

    $transaction->credits()->create([
        'amount' => $amount,
        'account_id' => $payment_account,
    ]);

    return $transaction->transaction_id;
}

function finger_image($candidate)
{
    $file_name_one = time().'__'.time().'_one'.'.png';
    $file_name_two = time().'__'.time().'_two'.'.png';
    $font_name= public_path("assets/fonts/arial/GothicA1-Light.ttf");

    $page_one = imagecreatefrompng(asset('public/images/finger/page_one.png'));
    $color = imagecolorallocate($page_one, 19,21,22);
    $name = $candidate->fName." ".$candidate->lName;
    $fathers_name = $candidate->father_name;
    $mothers_name = $candidate->mother_name;
    $spouse = $candidate->spouse_name;
    $dob = $candidate->data_of_birth;
    $passport = $candidate->passportNum;
    $nationality = $candidate->nationality;
    $birth_palce = $candidate->birth_palce;
    $passport_place = $candidate->passport_place;
    $issue_date = new DateTime($candidate->issue_date);
    $passport_date = $issue_date->format('d-m-Y');

    $exp_date = new DateTime($candidate->issue_date);
    $exp_date->add(new DateInterval("P".$candidate->validity."Y"));
    $passport_exp_date = $exp_date->format('d-m-Y');

    $gender = $candidate->gender;
    $religion = $candidate->religion;
    $division = $candidate->division;
    $district = $candidate->district;
    $upzilla = $candidate->upzilla;
    $union = $candidate->union;
    $house_village = $candidate->house_village;
    $road_mouza = $candidate->road_mouza;
    $post_office = $candidate->post_office;
    $post_code = $candidate->post_code;
    $mobile = $candidate->phone;
    $professional = $candidate->passportNum;
    imagettftext($page_one, 20, 0, 175, 587, $color, $font_name, $name);
    imagettftext($page_one, 20, 0, 455, 662, $color, $font_name, $fathers_name);
    imagettftext($page_one, 20, 0, 455, 722, $color, $font_name, $mothers_name);
    imagettftext($page_one, 20, 0, 376, 848, $color, $font_name, $spouse);
    imagettftext($page_one, 20, 0, 376, 911, $color, $font_name, $dob);
    imagettftext($page_one, 20, 0, 1100, 892, $color, $font_name, $passport);
    imagettftext($page_one, 20, 0, 376, 975, $color, $font_name, $nationality);
    imagettftext($page_one, 20, 0, 376, 1038, $color, $font_name, $birth_palce);
    imagettftext($page_one, 20, 0, 1100, 942, $color, $font_name, $passport_place);
    imagettftext($page_one, 20, 0, 1100, 998, $color, $font_name, $passport_date);
    imagettftext($page_one, 20, 0, 1100, 1100, $color, $font_name, $passport_exp_date);
    imagettftext($page_one, 20, 0, 376, 1103, $color, $font_name, $gender);
    imagettftext($page_one, 20, 0, 376, 1168, $color, $font_name, $religion);
    imagettftext($page_one, 20, 0, 376, 1325, $color, $font_name, $division);
    imagettftext($page_one, 20, 0, 1126, 1305, $color, $font_name, $district);
    imagettftext($page_one, 20, 0, 376, 1385, $color, $font_name, $upzilla);
    imagettftext($page_one, 20, 0, 1126, 1365, $color, $font_name, $union);
    imagettftext($page_one, 20, 0, 435, 1450, $color, $font_name, $road_mouza);
    imagettftext($page_one, 20, 0, 1126, 1425, $color, $font_name, $house_village);
    imagettftext($page_one, 20, 0, 376, 1510, $color, $font_name, $post_office);
    imagettftext($page_one, 20, 0, 1126, 1485, $color, $font_name, $post_code);
    imagettftext($page_one, 20, 0, 376, 1570, $color, $font_name, $mobile);
    imagettftext($page_one, 20, 0, 416, 2051, $color, $font_name, $professional);
    
    imagepng($page_one, storage_path("app/public/candidate/finger/$file_name_one"));
    imagedestroy($page_one);

    $page_two = imagecreatefrompng(asset('public/images/finger/page_two.png'));
    $color = imagecolorallocate($page_two, 19,21,22);

    $nominee_name = $candidate->nominee;
    $nominee_relation = $candidate->nominee_relation;
    $contact_name = $candidate->contact_name;
    imagettftext($page_two, 20, 0, 385, 1420, $color, $font_name, $nominee_relation);
    imagettftext($page_two, 20, 0, 1100, 1418, $color, $font_name, $nominee_name);
    imagettftext($page_two, 20, 0, 385, 1970, $color, $font_name, $contact_name);

    imagepng($page_two, storage_path("app/public/candidate/finger/$file_name_two"));
    imagedestroy($page_two);

    return array($file_name_one, $file_name_two);
}