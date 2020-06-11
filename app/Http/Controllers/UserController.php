<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create-users', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-users'  , ['only' => ['index']]);
        $this->middleware('permission:update-users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy','destroySelecteds']]);

        $roles = Role::all();
        View::share(compact('roles'));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with(compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|string',
        ]);

        $role = $request->role;
        $password = bcrypt($request->password);
        if($request->info_names) $info = array_combine($request->info_names,$request->info_values);
        else $info = json_encode(['address' => 'Baku, Azerbaijan']);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->info = $info;
        $user->save();
        $user->attachRole($role);

        $data = [
            'status'    => 'success',
            'message'   => "User - <span class='font-weight-semibold'>{$user->name}</span> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
        ]);

        $data = $request->all();
        if($data['info_names']) $info = array_combine($data['info_names'],$data['info_values']);
        else $info = ['address' => 'Baku, Azerbaijan'];

        $oldData = $user->name;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->info = $info;
        if($data['password']){
            $password = bcrypt($data['password']);
            $user->password = $password;
        }

        $user->detachRoles($user->roles);
        $user->attachRole($data['role']);
        $user->save();

        $data = [
            'status'    => 'success',
            'message'   => "User - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }


    public function destroy(User $user)
    {
        $oldData = $user->name;
        $user->delete();

        $data = [
            'status'    => 'success',
            'message'   => "User - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = User::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>users</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
