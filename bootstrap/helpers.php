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
        'account_id' => '1',
    ]);

    $transaction->credits()->create([
        'amount' => $amount,
        'account_id' => $payment_account,
    ]);

    return $transaction->transaction_id;
}