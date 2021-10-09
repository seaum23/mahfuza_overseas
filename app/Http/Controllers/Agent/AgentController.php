<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        
        if($validate_existing_agent->isEmpty()){
            $agent = Agent::create([
                'full_name' => $request->agentName,
                'email' => $request->agentEmail,
                'phone' => $request->agentPhone,
                'comment' => $request->comment,
                'updated_by' => auth()->id(),
                'password' => $request->password,
            ]);    
    
            $agent->photo = move($request->agentImage, 'app/uploads/agent/', 'agent_photo_' . $agent->id );
    
            $agent->passport = move($request->agentPassport, 'app/uploads/agent/', 'agent_passport_' . $agent->id );
    
            $agent->police_clearance = move($request->agentPolice, 'app/uploads/agent/', 'agent_police_verification_' . $agent->id );
    
            $agent->save();

            return redirect('test');
        }else{
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
        }
         
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
}
