<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-menus', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-menus'  , ['only' => ['index']]);
        $this->middleware('permission:update-menus', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-menus', ['only' => ['destroy','destroySelecteds']]);
    }

    public function index()
    {
        $menus = Menu::getMenus();
        return view('admin.menus.index')->with(compact('menus'));
    }


    public function create()
    {
        $menus = Menu::getMenus();
        $pages = Page::where('status',true)->where('locale',getLocale())->get();
        return view('admin.menus.create')->with(compact('menus','pages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|string|nullable',
            'name' => 'required|string|unique:menus',
            'description' => 'string|nullable',
            'target' => 'required|array',
            'target.*' => 'required|string',
            'url' => 'string|nullable',
            'order' => 'required|integer'
        ]);

        $menu = new Menu();
        $menu->parent_id = $request->parent_id==='null'?null:$request->parent_id;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->target = json_encode($request->target);
        $menu->url = $request->url;
        $menu->order = $request->order;
        $menu->status = $request->status?true:false;
        $menu->author_id = user()->id;
        $menu->save();

        $data = [
            'status'    => 'success',
            'message'   => "Menu - <span class='font-weight-semibold'>{$menu->name}</span> is created successfully!"
        ];
        return response()->json($data,200);
    }


    public function show($id)
    {
        //
    }


    public function edit(Menu $menu)
    {
        $menus = Menu::getMenus();
        $pages = Page::where('status',true)->get();
        return view('admin.menus.edit')->with(compact('menu','menus','pages'));
    }


    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'parent_id' => 'required|string|nullable',
            'name' => 'required|string|unique:menus,name,'.$menu->id,
            'description' => 'string|nullable',
            'target' => 'required|array',
            'target.*' => 'required|string',
            'url' => 'string|nullable',
            'order' => 'required|integer'
        ]);


        $oldData = $menu->name;
        $menu->parent_id = $request->parent_id==='null'?null:$request->parent_id;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->order = $request->order;
        $menu->status = $request->status?true:false;
        $menu->target = json_encode($request->target);
        $menu->url = $request->url;
        $menu->save();

        $data = [
            'status'    => 'success',
            'message'   => "Menu - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }


    public function destroy(Menu $menu)
    {
        $oldData = $menu->name;
        $menu->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Menu - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            if($deleteData = Menu::find($selected)){
                $deleteData->delete();
            }
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>menus</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }

}
