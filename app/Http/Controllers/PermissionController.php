<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-permissions'  , ['only' => ['index']]);
        $this->middleware('permission:update-permissions', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permissions', ['only' => ['destroy','destroySelecteds']]);
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index')->with(compact('permissions'));
    }


    public function create()
    {
        return view('admin.permissions.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions',
            'display_name' => 'required|string',
            'description' => 'required|string',
            'module' => 'required|string'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module = $request->module;
        $permission->save();

        $data = [
            'status'    => 'success',
            'message'   => "Permission - <span class='font-weight-semibold'>{$permission->display_name}</span> is created successfully!"
        ];
        return response()->json($data,200);
    }


    public function show($id)
    {
        //
    }


    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit')->with(compact('permission'));
    }


    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string',
            'display_name' => 'required|string',
            'description' => 'required|string',
            'module' => 'required|string'
        ]);

        $oldData = $permission->display_name;
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module = $request->module;
        $permission->save();

        $data = [
            'status'    => 'success',
            'message'   => "Permission - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }


    public function destroy(Permission $permission)
    {
        $oldData = $permission->display_name;
        $permission->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Permission - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Permission::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>permissions</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
