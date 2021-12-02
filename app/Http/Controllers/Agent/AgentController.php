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

        $agent->passport = move($request->agentPassport, 'agent', 'agent_passport_' . $agent->id . '_' . time() );

        $agent->police_clearance = move($request->agentPolice, 'agent', 'agent_police_verification_' . $agent->id . '_' . time() );

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
                return '<a href="'.asset($query->passport).'"><button class="btn btn-info btn-sm"> Passport </button></a> <a href="'.asset($query->police_clearance).'"> <button class="btn btn-warning btn-sm"> Clearance </button> </a>';
            })            
            ->addColumn('action', function ($query) {
                return '<button onclick="edit_agent(\''.$query->full_name.'\', \''.$query->email.'\', \''.$query->phone.'\', \''.$query->comment.'\', '.$query->id.' )" data-toggle="modal" data-target="#update_agent_modal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit </button>';
            })
            ->rawColumns(['document', 'photo', 'action'])
            ->make(true);
        }
    }
}
