<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.role_permission.roles_list', [
            'permissions' => Role::paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request->role_name]);
    }

    public function permission_of_role($role)
    {
        return view('form_templates.permission-of-roles', [
            'permissions' => DB::table('permissions')
                                ->leftJoin('role_has_permissions', function ($join) use ($role) {
                                    $join->on('permissions.id', '=', 'role_has_permissions.permission_id')
                                        ->where('role_has_permissions.role_id', $role);
                                })
                                ->select('permissions.*', 'role_has_permissions.permission_id as has_permission')
                                ->get(),
        'role' => $role ])->render();
    }

    public function permission_to_role(Role $role, Permission $permission)
    {
        $role->givePermissionTo($permission);
    }
}
