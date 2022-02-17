<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use function PHPUnit\Framework\isEmpty;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.agent.agent_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.agent.new_agent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'agentName' => 'required',
            'agentEmail' => 'required',
            'agentPhone' => 'required',
            'password' => 'required',
            'agentImage' => 'required',
        ]);

        $validate_existing_agent = Agent::where('email', $request->agentEmail)
            ->orWhere('phone', $request->agentPhone)
            ->get();
        
        if(!$validate_existing_agent->isEmpty()){
            if($request->agentEmail == $validate_existing_agent[0]->email){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'agentEmail' => ['Email already exists!'],
                ]);
            }else{
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'agentPhone' => ['Phone already exists!'],
                ]);
            }            
            throw $error;
            return;            
        }

        $agent = Agent::create([
            'full_name' => $request->agentName,
            'opening_balance' => (!empty($request->opening_balance)) ? $request->opening_balance : 0,
            'email' => $request->agentEmail,
            'phone' => $request->agentPhone,
            'comment' => $request->comment,
            'updated_by' => auth()->id(),
            'password' => $request->password,
        ]);    

        $agent->photo = move($request->agentImage, 'agent', 'agent_photo_' . $agent->id . '_' . time() );

        if(!empty($request->agentPassport)){
            $agent->passport = move($request->agentPassport, 'agent', 'agent_passport_' . $agent->id . '_' . time() );
        }

        if(!empty($request->balance_sheet)){
            $agent->balance_sheet = move($request->balanceSheet, 'agent', 'agent_balance_sheet_' . $agent->id . '_' . time() );
        }

        $agent->save();
         
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
    public function update(Request $request, Agent $agent)
    {
        $validate = Agent::where('email', $request->agentEmail)
            ->orWhere('phone', $request->agentPhone)
            ->get();
        if($validate->isEmpty() OR ( $request->agentEmail == $agent->email AND $request->agentPhone == $agent->phone )){
            $agent->email = $request->agentEmail;
            $agent->phone = $request->agentPhone;
            $agent->full_name = $request->agentName;
            $agent->comment = $request->comment;

            if(!empty($request->agentImage)){
                $agent->photo = move($request->agentImage, 'agent', 'agent_photo_' . $agent->id . '_' . time() );
            }

            if(!empty($request->agentPassport)){
                $agent->passport = move($request->agentPassport, 'agent', 'agent_passport_' . $agent->id . '_' . time() );
            }

            if(!empty($request->balance_sheet)){
                $agent->balance_sheet = move($request->balanceSheet, 'agent', 'agent_balance_sheet_' . $agent->id . '_' . time() );
            }

            $agent->save();

            alert($request);

        }else{
            if($request->agentEmail == $validate[0]->email){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'agentEmail' => ['Email already exists!'],
                ]);
            }else{
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'agentPhone' => ['Phone already exists!'],
                ]);
            }            
            throw $error;
        }
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

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {        
        if ($request->ajax()) {
            $query = Agent::get();
            
            return Datatables::of($query)
            ->editColumn('photo', function ($query)
            {
                return '<img class="table-photo" src="'.asset($query->photo).'">';
            })
            ->addColumn('document', function ($query) {
                return '<a href="'.asset($query->passport).'"><button class="btn btn-info btn-sm"> Passport </button></a> <a href="'.asset($query->balance_sheet).'"> <button class="btn btn-warning btn-sm"> Balance Sheet </button> </a>';
            })                  
            ->addColumn('balance', function ($query) {
                $credit = $query->transactions()
                            ->join('credits', 'transactions.id', '=', 'credits.transaction_id')
                            ->where(function ($query)
                            {
                                $query->where('credits.account_id', '1')
                                    ->orWhere('credits.account_id', '2');
                            })
                            ->sum('credits.amount');
                $debit = $query->transactions()
                            ->join('debits', 'transactions.id', '=', 'debits.transaction_id')
                            ->where(function ($query)
                            {
                                $query->where('debits.account_id', '1')
                                    ->orWhere('debits.account_id', '2');
                            })
                            ->sum('debits.amount');
                return $query->opening_balance + $credit - $debit;
            })      
            ->addColumn('action', function ($query) {
                $html = '<div class="btn-group" role="group" aria-label="Basic example">';
                $html .= '<button onclick="transaction_particular_select(\'agent\', '.$query->id.')" data-toggle="modal" data-target="#transaction_modal_specific" class="btn btn-warning btn-xs"><i class="fas fa-dollar-sign"></i></button>';
                $html .= '<button onclick="edit_agent(\''.$query->full_name.'\', \''.$query->email.'\', \''.$query->phone.'\', \''.$query->comment.'\', '.$query->id.' )" data-toggle="modal" data-target="#update_agent_modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit </button>';
                $html .= '<button onclick="balance_sheet(\''.$query->full_name.'\', \''.$query->email.'\', \''.$query->phone.'\', \''.$query->comment.'\', '.$query->id.' )" data-toggle="modal" data-target="#ledger_modal" class="btn btn-success btn-sm"><i class="fas fa-file-invoice-dollar"></i> </button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['document', 'photo', 'action'])
            ->make(true);
        }
    }

    public function balanace_sheet(Agent $agent)
    {
        return view('templates.ledger.agent-ledger', [
            'transactions' => $agent->transactions()->with('credits', 'debits')->latest()->get()
        ]);
    }
}
