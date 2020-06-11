<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:create-roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-roles'  , ['only' => ['index']]);
        $this->middleware('permission:update-roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-roles', ['only' => ['destroy','destroySelecteds']]);

        $permissions = Permission::all();
        $roles = Role::all();
        View::share(compact('permissions','roles'));
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|string|unique:roles',
            'display_name' => 'required|string',
            'description' => 'required|string',
            'permissions' => 'required|array'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        foreach ($request->permissions as $permissionId){
            DB::table('permission_role')->insert([
                'permission_id' => $permissionId,
                'role_id' => $role->id
            ]);
        }

        $data = [
            'status'    => 'success',
            'message'   => "Role - <span class='font-weight-semibold'>{$role->display_name}</span> is created successfully"
        ];
        return response()->json($data,200);
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

    public function edit(Role $role)
    {
        return view('admin.roles.edit')->with(compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string',
            'display_name' => 'required|string',
            'description' => 'required|string',
            'permissions' => 'required|array'
        ]);

        $oldData = $role->display_name;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        $permission_role = DB::table('permission_role');
        $permission_role->where('role_id',$role['id'])->delete();


        foreach ($request->permissions as $permissionId){
            $permission_role->insert([
                'permission_id' => $permissionId,
                'role_id' => $role->id
            ]);
        }

        $data = [
            'status'    => 'success',
            'message'   => "Role - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroy(Role $role)
    {
        $oldData = $role->display_name;
        $role->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Role - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Role::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>roles</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
