<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.accounts.accounts_list', [
            'assets' => Account::select('account')->where('account_type', 'asset')->paginate(10),
            'liabilities' => Account::select('account')->where('account_type', 'liability')->paginate(10),
            'revenues' => Account::select('account')->where('account_type', 'revenue')->paginate(10),
            'expenseces' => Account::select('account')->where('account_type', 'expense')->paginate(10),
            'equities' => Account::select('account')->where('account_type', 'equity')->paginate(10),
        ]);
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
    public function store($account_type, Request $request)
    {
        $request->validate([
            'account_name' => 'required'
        ]);

        $account_type_db = '';
        switch($account_type){
            case 'asset':
                $account_type_db = 'asset';
                break;
            case 'liability':
                $account_type_db = 'liability';
                break;
            case 'revenue':
                $account_type_db = 'revenue';
                break;
            case 'expense':
                $account_type_db = 'expense';
                break;
            case 'equity':
                $account_type_db = 'equity';
                break;
            default:
                throw ValidationException::withMessages(['error' => 'Account Type Does Not Exists!']);
        }

        $payment_account = 0;
        if(isset($request->payment_account)){
            $payment_account = 1;
        }

        Account::create([
            'account' => $request->account_name,
            'account_type' => $account_type_db,
            'payment_account' => $payment_account,
        ]);
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
