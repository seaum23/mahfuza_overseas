<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\MaheerTransaction;
use App\Models\ManpowerOffice;
use App\Models\OutsideOffice;
use Yajra\Datatables\Datatables;


class MaheerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.maheer.account');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'rate' => 'required|min:1',
            'currency' => 'required|in:dollar,riyal',
            'amount' => 'required',
            'date' => 'required',
        ]);
        
        $transaction = new MaheerTransaction();
        $transaction->currency = $request->currency;
        $transaction->debit = ($request->amount * $request->rate);
        $transaction->exchange_rate = $request->rate;
        $transaction->transaction_type = 1;  
        $transaction->input_date = $request->date;
        $transaction->save();
        if(!empty($request->maheer_account_file)){
            $transaction->receipt = move($request->maheer_account_file, 'maheer', 'maheer_receipt_' . $transaction->id . '_' . time() );
        }

        $debit_sum = MaheerTransaction::sum('debit');
        $credit_sum = MaheerTransaction::sum('credit');
        
        $transaction->adjusted_value = ($debit_sum - $credit_sum);
        $transaction->save();
    }

    public function store_expense(Request $request)
    {
        // $request->validate([
        //     'amount' => 'required',
        //     'rate' => 'required|min:1',
        //     'currency' => 'required|in:dollar,riyal',
        //     'amount' => 'required',
        //     'date' => 'required',
        // ]);

        switch($request->particular_type){
            case 'Manpower Office':
                $particular_type = ManpowerOffice::class;
                break;
            case 'Outside Office':
                $particular_type = OutsideOffice::class;
                break;
            default:
                $particular_type = null;
        }
        
        $transaction = new MaheerTransaction();
        $transaction->currency = 'bdt';
        $transaction->credit = $request->expense_amount;
        $transaction->exchange_rate = 1;
        $transaction->input_date = date('Y-m-d');
        $transaction->transaction_type = 1;  
        if(!is_null($particular_type)){
            $transaction->particular_type = $particular_type;
            $transaction->particular_id = $request->agent_id;
        }
        $transaction->save();
        if(!empty($request->expense_receipt)){
            $transaction->receipt = move($request->expense_receipt, 'maheer', 'maheer_receipt_' . $transaction->id . '_' . time() );
        }

        $debit_sum = MaheerTransaction::sum('debit');
        $credit_sum = MaheerTransaction::sum('credit');
        
        $transaction->adjusted_value = ($debit_sum - $credit_sum);
        $transaction->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = MaheerTransaction::orderBy('id', 'desc')->get();

            
            return Datatables::of($query)
            // ->editColumn('photo', function ($query)
            // {
            //     return '<img class="table-photo" src="'.asset($query->photo).'">';
            // })
            ->addColumn('receipt', function ($query) {
                return (!is_null($query->receipt)) ? '<a target="_blank" href="'.asset($query->receipt).'"><button type="button" class="btn btn-info btn-sm"> Receipt </button></a>' : '';
            })                  
            ->addColumn('particular', function ($query) {
                $particular = $query->particular;

                if($particular instanceof ManpowerOffice){
                    return $particular->name;
                }

                if($particular instanceof OutsideOffice){
                    return $particular->name;
                }

                if($particular instanceof Candidate){
                    return $particular->fName . ' ' . $particular->lName;
                }
                
                return '';
            })      
            // ->addColumn('action', function ($query) {
            //     $html = '<div class="btn-group" role="group" aria-label="Basic example">';
            //     $html .= '<button onclick="transaction_particular_select(\'agent\', '.$query->id.')" data-toggle="modal" data-target="#transaction_modal_specific" class="btn btn-warning btn-xs"><i class="fas fa-dollar-sign"></i></button>';
            //     $html .= '<button onclick="edit_agent(\''.$query->full_name.'\', \''.$query->email.'\', \''.$query->phone.'\', \''.$query->comment.'\', '.$query->id.' )" data-toggle="modal" data-target="#update_agent_modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit </button>';
            //     $html .= '<button onclick="balance_sheet(\''.$query->full_name.'\', \''.$query->email.'\', \''.$query->phone.'\', \''.$query->comment.'\', '.$query->id.' )" data-toggle="modal" data-target="#ledger_modal" class="btn btn-success btn-sm"><i class="fas fa-file-invoice-dollar"></i> </button>';
            //     $html .= '</div>';
            //     return $html;
            // })
            ->rawColumns(['receipt', 'particular'])
            ->make(true);
        }
    }

    public function account_types($type)
    {
        if($type == 'Manpower Office'){
            return view('form_templates.account_type_manpower', [
                'manpowers' => ManpowerOffice::get()
            ])->render();
        }

        if($type == 'Outside Office'){
            return view('form_templates.account_type_office', [
                'offices' => OutsideOffice::get()
            ])->render();
        }

        
    }
}
