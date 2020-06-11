<?php

namespace App\Http\Controllers;

use App\TranslationGroup;
use Illuminate\Http\Request;

class TranslationGroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create-translation-groups', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-translation-groups'  , ['only' => ['index']]);
        $this->middleware('permission:update-translation-groups', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-translation-groups', ['only' => ['destroy','destroySelecteds']]);
    }

    public function index()
    {
        $translation_groups = TranslationGroup::all();
        return view('admin.translation_groups.index')->with(compact('translation_groups'));
    }


    public function create()
    {
        return view('admin.translation_groups.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:translation_groups',
            'description' => 'required|string',
        ]);

        $translation_group = new TranslationGroup();
        $translation_group->name = $request->name;
        $translation_group->description = $request->description;
        $translation_group->save();

        $data = [
            'status'    => 'success',
            'message'   => "Translation group - <span class='font-weight-semibold'>{$translation_group->name}</span> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show(TranslationGroup $translationGroup)
    {
        //
    }

    public function translations(TranslationGroup $translationGroup){
        $translations = $translationGroup->translations()->get();
        $data = [];
        foreach ($translations as $translation){
            $translation->translationGroup = $translation->group->name;
//            dd($translation);
            $translationValue = json_decode($translation->value,1);
            $translationValue = $translationValue[getLocale()] ?? "{$translation->translationGroup}.{$translation->key}";
            $translation->value = $translationValue;
            unset($translation->group);
            $data[] = $translation;
        }
        return response()->json($data,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }


    public function edit(TranslationGroup $translation_group)
    {
        return view('admin.translation_groups.edit')->with(compact('translation_group'));
    }

    public function update(Request $request, TranslationGroup $translation_group)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $oldData = $translation_group->name;
        $translation_group->name = $request->name;
        $translation_group->description = $request->description;
        $translation_group->status = $request->status?true:false;
        $translation_group->save();

        $data = [
            'status'    => 'success',
            'message'   => "Translation group - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(TranslationGroup $translation_group)
    {
        $oldData = $translation_group->name;
        $translation_group->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Translation Group - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = TranslationGroup::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>translation groups</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
