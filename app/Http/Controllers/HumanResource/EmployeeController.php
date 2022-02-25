<?php

namespace App\Http\Controllers\HumanResource;

use Validator;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $designations = Role::get();
        return view('templates.new_employee', [
            'designations' => $designations
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'max:11|min:11'
        ]);
        
        $user = User::create([
            'employee_id' => $request->officeId,
            'name' => $request->name,
            'designation_id' => $request->designation,
            'phone' => $request->phoneNumber,
            'address' => $request->address,
            'password' => Hash::make($request->password_text),
        ]);
        $user->syncRoles([$request->designation]);

        return back();
    }

    public function show()
    {
        $employees = User::with('roles')->get();
        return view('templates.employee_list', [
            'employees' => $employees,
            'roles' => Role::get(),
        ]);
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'password' => 'required|confirmed'
                    ]);
        if ($validator->passes()) {
            $employee = User::find($request->employeeId);
            if(Hash::check($request->old_password, $employee->password)){
                $employee->password = Hash::make($request->password);
                $employee->save();
                return response()->json([
                    'mismatch' => '',
                    'error' => '',
                ]);
            }else{
                return response()->json([
                    'mismatch' => 'Password did not match!',
                    'error' => '',
                ]);                
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
    public function update_fetch(User $user)
    {
        $json = $user;
        $designations = Role::get();
        $designation_option = '<option>Select Role</option>';
        foreach($designations as $designation){
            if($user->hasRole($designation->name)){
                $designation_option .= '<option '.$designation->id.' selected>' . $designation->name . '</option>';
            }else{
                $designation_option .= '<option '.$designation->id.' >' . $designation->name . '</option>';
            }
        }
        $json->designation = $designation_option;
        return json_encode($json);
    }

    public function update(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->employee_id = $request->updateEmployeeId;
        $user->phone = $request->phoneNumber;
        $user->address = $request->address;
        $user->save();
        if(!empty($request->role)){
            $user->syncRoles([$request->role]);
        }
        $employees = User::get();
        return view('templates.employee_list', [
            'employees' => $employees
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return back();
    }
}
