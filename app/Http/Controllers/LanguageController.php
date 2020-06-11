<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-languages', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-languages'  , ['only' => ['index']]);
        $this->middleware('permission:update-languages', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-languages', ['only' => ['destroy','destroySelecteds']]);

        $languages = Language::all();
        View::share(compact('languages'));
    }

    public function index()
    {
        return view('admin.languages.index');
    }


    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:languages',
            'name' => 'required|string',
            'description' => 'string',
            'order' => 'required|integer',
        ]);

        $language = new Language();
        $language->key = $request->key;
        $language->name = $request->name;
        $language->description = $request->description;
        $language->order = $request->order;
        $language->save();

        $data = [
            'status'    => 'success',
            'message'   => "Language - <span class='font-weight-semibold'>{$language->name}</span> is created successfully!"
        ];
        return response()->json($data,200);
    }


    public function show(Language $language)
    {
        //
    }


    public function edit(Language $language)
    {
        return view('admin.languages.edit')->with(compact('language'));
    }


    public function update(Request $request, Language $language)
    {
        $request->validate([
            'key' => 'required|string',
            'name' => 'required|string',
            'description' => 'string',
            'order' => 'required|integer',
        ]);

        $oldData = $language->name;
        $language->key = $request->key;
        $language->name = $request->name;
        $language->description = $request->description;
        $language->order = $request->order;
        $language->status = $request->status?true:false;
        $language->save();

        $data = [
            'status'    => 'success',
            'message'   => "Language - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroy(Language $language)
    {
        $oldData = $language->name;
        $language->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Language - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Language::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>languages</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
