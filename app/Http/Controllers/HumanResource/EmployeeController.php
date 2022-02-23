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
        
        User::create([
            'employee_id' => $request->officeId,
            'name' => $request->name,
            'designation_id' => $request->designation,
            'phone' => $request->phoneNumber,
            'address' => $request->address,
            'password' => Hash::make($request->password_text),
        ]);
    }

    public function show()
    {
        $employees = User::get();
        return view('templates.employee_list', [
            'employees' => $employees
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
        $json = json_decode($user->toJson());
        $designations = Designation::get();
        $designation_option = '';
        foreach($designations as $designation){
            if($designation->id == $user->designation_id){
                $designation_option .= '<option '.$designation->id.' selected>' . $designation->designation . '</option>';
            }else{
                $designation_option .= '<option '.$designation->id.' >' . $designation->designation . '</option>';
            }
        }
        $json->designation = $designation_option;
        return json_encode($json);
    }

    public function update(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->employee_id = $request->officeId;
        $user->phone = $request->phoneNumber;
        $user->address = $request->address;
        $user->save();
        $employees = User::get();
        return view('templates.employee_list', [
            'employees' => $employees
        ]);
    }
}
