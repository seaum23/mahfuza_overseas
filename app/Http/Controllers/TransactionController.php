<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\ManpowerOffice;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function get_particular(Request $request)
    {
        $html = '<option value=""></option>';
        switch($request->particular_type){
            case 'agent':
                $particulars = Agent::all();
                foreach($particulars as $particular){
                    $html .= '<option value="'.$particular->id.'">'.$particular->full_name.'</option>';
                }
                return $html;
            case 'delegate':
                $particulars = Delegate::all();
                foreach($particulars as $particular){
                    $html .= '<option value="'.$particular->id.'">'.$particular->name.'</option>';
                }
                return $html;
            case 'manpower':
                $particulars = ManpowerOffice::all();
                foreach($particulars as $particular){
                    $html .= '<option value="'.$particular->id.'">'.$particular->name.'</option>';
                }
                return $html;
            default:
                return;
        }
    }

    public function make_transaction(Request $request)
    {
        $account = Account::find($request->account);
        switch($request->particular_type){
            case 'agent':
                $particular_type = Agent::class;
                break;
            case 'delegate':
                $particular_type = Delegate::class;
                break;
            case 'manpower':
                $particular_type = ManpowerOffice::class;
                break;
            default:
                $particular_type = null;
        }

        // Accounts receivable / পাবো
        if($request->account == '1'){
            /**
             * If left & right amount are equal that means no money is due.
             * Only one transaction will be created.
             */

            // Transaction #1
            $transaction = new Transaction();
            $transaction->quantity = 1;
            $transaction->currency = 'bdt';
            $transaction->unit_price = $request->left_input;
            $transaction->exchange_rate = 1;
            if(!is_null($particular_type)){
                $transaction->particular_type = $particular_type;
                $transaction->particular_id = $request->particular;
            }
            if(!empty($request->transaction_candidate_id)){
                $transaction->candidate_id = $request->transaction_candidate_id;
            }
            $transaction->note = $request->note;
            $transaction->purpose = $request->purpose;
            $transaction->save();
            $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
            $transaction->save();

            $transaction->credits()->create([
                'amount' => $request->left_input,
                'account_id' => $request->account,
            ]);

            $transaction->debits()->create([
                'amount' => $request->left_input,
                'account_id' => $request->payment_account,
            ]);

            return;            
        }

        // Accounts payable / পাবে
        if($request->account == '2'){
            /**
             * If left & right amount are equal that means no money is due.
             * Only one transaction will be created.
             */

            // Transaction #1
            $transaction = new Transaction();
            $transaction->quantity = 1;
            $transaction->currency = 'bdt';
            $transaction->unit_price = $request->right_input;
            $transaction->exchange_rate = 1;
            if(!is_null($particular_type)){
                $transaction->particular_type = $particular_type;
                $transaction->particular_id = $request->particular;
            }
            if(!empty($request->transaction_candidate_id)){
                $transaction->candidate_id = $request->transaction_candidate_id;
            }
            $transaction->note = $request->note;
            $transaction->purpose = $request->purpose;
            $transaction->save();
            $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
            $transaction->save();

            $transaction->debits()->create([
                'amount' => $request->right_input,
                'account_id' => $request->account,
            ]);

            $transaction->credits()->create([
                'amount' => $request->right_input,
                'account_id' => $request->payment_account,
            ]);

            return;            
        }

        if($account->account_type == 'asset'){

            /**
             * If left & right amount are equal that means no money is due.
             * Only one transaction will be created.
             */
            if($request->left_input == $request->right_input){

                // Transaction #1
                $transaction = new Transaction();
                $transaction->quantity = 1;
                $transaction->currency = 'bdt';
                $transaction->unit_price = $request->left_input;
                $transaction->exchange_rate = 1;
                if(!is_null($particular_type)){
                    $transaction->particular_type = $particular_type;
                    $transaction->particular_id = $request->particular;
                }
                if(!empty($request->transaction_candidate_id)){
                    $transaction->candidate_id = $request->transaction_candidate_id;
                }
                $transaction->note = $request->note;
                $transaction->purpose = $request->purpose;
                $transaction->save();
                $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                $transaction->save();

                $transaction->debits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->account,
                ]);

                $transaction->credits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->payment_account,
                ]);

                return;
            }

            /**
             * If left is greater then right amount that means some money is due.
             * Two transaction will be created with respect to Accounts payable / পাবে.
             */
            if($request->left_input > $request->right_input){

                // Transaction #1
                $transaction = new Transaction();
                $transaction->quantity = 1;
                $transaction->currency = 'bdt';
                $transaction->unit_price = $request->left_input;
                $transaction->exchange_rate = 1;
                $transaction->particular_type = $particular_type;
                $transaction->particular_id = $request->particular;
                if(!empty($request->transaction_candidate_id)){
                    $transaction->candidate_id = $request->transaction_candidate_id;
                }
                $transaction->note = $request->note;
                $transaction->purpose = $request->purpose;
                $transaction->save();
                $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                $transaction->save();

                $transaction->debits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->account,
                ]);

                $transaction->credits()->create([
                    'amount' => $request->left_input,
                    'account_id' => '2',
                ]);

                // Transaction #2
                if($request->right_input > 0){
                    $transaction = new Transaction();
                    $transaction->quantity = 1;
                    $transaction->currency = 'bdt';
                    $transaction->unit_price = $request->right_input;
                    $transaction->exchange_rate = 1;
                    $transaction->particular_type = $particular_type;
                    $transaction->particular_id = $request->particular;
                    if(!empty($request->transaction_candidate_id)){
                        $transaction->candidate_id = $request->transaction_candidate_id;
                    }
                    $transaction->note = $request->note;
                    $transaction->purpose = $request->purpose;
                    $transaction->save();
                    $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                    $transaction->save();
    
                    $transaction->debits()->create([
                        'amount' => $request->right_input,
                        'account_id' => '2',
                    ]);
    
                    $transaction->credits()->create([
                        'amount' => $request->right_input,
                        'account_id' => $request->payment_account,
                    ]);

                    return;
                }
            }
        }

        if($account->account_type == 'revenue'){
            /**
             * If left & right amount are equal that means no money is due.
             * Only one transaction will be created.
             */
            if($request->left_input == $request->right_input){

                // Transaction #1
                $transaction = new Transaction();
                $transaction->quantity = 1;
                $transaction->currency = 'bdt';
                $transaction->unit_price = $request->left_input;
                $transaction->exchange_rate = 1;
                if(!is_null($particular_type)){
                    $transaction->particular_type = $particular_type;
                    $transaction->particular_id = $request->particular;
                }
                if(!empty($request->transaction_candidate_id)){
                    $transaction->candidate_id = $request->transaction_candidate_id;
                }
                $transaction->note = $request->note;
                $transaction->purpose = $request->purpose;
                $transaction->save();
                $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                $transaction->save();

                $transaction->credits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->account,
                ]);

                $transaction->debits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->payment_account,
                ]);

                return;
            }

            /**
             * If left is greater then right amount that means some money is due.
             * Two transaction will be created with respect to Accounts receivable / পাবো.
             */
            if($request->left_input > $request->right_input){

                // Transaction #1
                $transaction = new Transaction();
                $transaction->quantity = 1;
                $transaction->currency = 'bdt';
                $transaction->unit_price = $request->left_input;
                $transaction->exchange_rate = 1;
                $transaction->particular_type = $particular_type;
                $transaction->particular_id = $request->particular;
                if(!empty($request->transaction_candidate_id)){
                    $transaction->candidate_id = $request->transaction_candidate_id;
                }
                $transaction->note = $request->note;
                $transaction->purpose = $request->purpose;
                $transaction->save();
                $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                $transaction->save();

                $transaction->credits()->create([
                    'amount' => $request->left_input,
                    'account_id' => $request->account,
                ]);

                $transaction->debits()->create([
                    'amount' => $request->left_input,
                    'account_id' => '1',
                ]);

                // Transaction #2
                if($request->right_input > 0){
                    $transaction = new Transaction();
                    $transaction->quantity = 1;
                    $transaction->currency = 'bdt';
                    $transaction->unit_price = $request->right_input;
                    $transaction->exchange_rate = 1;
                    $transaction->particular_type = $particular_type;
                    $transaction->particular_id = $request->particular;
                    if(!empty($request->transaction_candidate_id)){
                        $transaction->candidate_id = $request->transaction_candidate_id;
                    }
                    $transaction->note = $request->note;
                    $transaction->purpose = $request->purpose;
                    $transaction->save();
                    $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
                    $transaction->save();
    
                    $transaction->credits()->create([
                        'amount' => $request->right_input,
                        'account_id' => '1',
                    ]);
    
                    $transaction->debits()->create([
                        'amount' => $request->right_input,
                        'account_id' => $request->payment_account,
                    ]);

                    return;
                }
            }
        }
        
        if($account->account_type == 'expense'){
            /**
             * If left & right amount are equal that means no money is due.
             * Only one transaction will be created.
             */

            // Transaction #1
            $transaction = new Transaction();
            $transaction->quantity = 1;
            $transaction->currency = 'bdt';
            $transaction->unit_price = $request->right_input;
            $transaction->exchange_rate = 1;
            if(!is_null($particular_type)){
                $transaction->particular_type = $particular_type;
                $transaction->particular_id = $request->particular;
            }
            if(!empty($request->transaction_candidate_id)){
                $transaction->candidate_id = $request->transaction_candidate_id;
            }
            $transaction->note = $request->note;
            $transaction->purpose = $request->purpose;
            $transaction->save();
            $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
            $transaction->save();

            $transaction->debits()->create([
                'amount' => $request->right_input,
                'account_id' => $request->account,
            ]);

            $transaction->credits()->create([
                'amount' => $request->right_input,
                'account_id' => $request->payment_account,
            ]);

            return;
        }
        dd($account);
    }
}
