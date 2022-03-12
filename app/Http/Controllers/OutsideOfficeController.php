<?php

namespace App\Http\Controllers;

use App\Models\OutsideOffice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OutsideOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.outside_office.new_outside_office', [
            'offices' => OutsideOffice::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'office_name' => 'required'
        ]);

        $validate = OutsideOffice::where('name', $request->office_name)->get();
        if(!$validate->isEmpty()){
            throw ValidationException::withMessages(['office_name' => 'Same Office Already Exists']);
        }

        OutsideOffice::create([
            'name' => $request->office_name,
            'comment' => $request->comment,
        ]);

        return back();
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
        $validate = OutsideOffice::where('name', $request->update_office_name)->where('id', '!=', $id)->get();
        if(!$validate->isEmpty()){
            throw ValidationException::withMessages(['update_office_name' => 'Same Office Already Exists']);
        }

        OutsideOffice::where('id', $id)->update([
            'name' => $request->update_office_name,
            'comment' => $request->update_comment,
        ]);
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
