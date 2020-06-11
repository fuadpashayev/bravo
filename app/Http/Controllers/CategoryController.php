<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-categories'  , ['only' => ['index']]);
        $this->middleware('permission:update-categories', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-categories', ['only' => ['destroy','destroySelecteds']]);
    }
    public function index()
    {
        $categories = Category::getCategories();
        return view('admin.categories.index')->with(compact('categories'));
    }


    public function create()
    {
        $categories = Category::getCategories();
        return view('admin.categories.create')->with(compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|string|nullable',
            'name' => 'required|string|unique:categories',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $category = new Category();
        $category->parent_id = $request->parent_id==='null'?null:$request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->save();

        $data = [
            'status'    => 'success',
            'message'   => "Category - <span class='font-weight-semibold'>{$category->name}</span> is created successfully!"
        ];
        return response()->json($data,200);
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        $categories = Category::getCategories();
        return view('admin.categories.edit')->with(compact('category','categories'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'parent_id' => 'required|string|nullable',
            'name' => 'required|string',
            'description' => 'required|string',
            'order' => 'required|integer'
        ]);

        $oldData = $category->name;
        $category->parent_id = $request->parent_id==='null'?null:$request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->status = $request->status?true:false;
        $category->save();

        $data = [
            'status'    => 'success',
            'message'   => "Category - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }


    public function destroy(Category $category)
    {
        $oldData = $category->name;
        $category->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Category - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Category::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>categories</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }


}
