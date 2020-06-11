<?php

namespace App\Http\Controllers;

use App\Language;
use App\Translation;
use App\TranslationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TranslationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-translations', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-translations'  , ['only' => ['index']]);
        $this->middleware('permission:update-translations', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-translations', ['only' => ['destroy','destroySelecteds']]);

        $translation_groups = TranslationGroup::where('status',true)->get();
        $languages = Language::where('status',true)->get();
        View::share(compact('translation_groups','languages'));
    }


    public function index()
    {
        $translations = Translation::all();
        return view('admin.translations.index')->with(compact('translations'));
    }

    public function create($group=null)
    {
        return view('admin.translations.create')->with(compact('group'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required|integer',
            'key' => 'required|string',
            'value' => 'required|array',
        ]);

        $check = Translation::where(['group_id' => $request->group,'key' => $request->key])->first();
        if($check){
            $data = [
                'message' => translate('errors.givenDataInvalid'),
                'errors'  => [
                    'name'=> [translate('errors.nameAlreadyTaken')]
                ]
            ];
            return response()->json($data,422);
        }


        $translation = new Translation();
        $translation->group_id = $request->group;
        $translation->key = $request->key;
        $translation->value = json_encode($request->value,JSON_UNESCAPED_UNICODE );
        $translation->save();

        $data = [
            'status'    => 'success',
            'message'   => "Translation - <span class='font-weight-semibold'>{$translation->key}</span> is created successfully!"
        ];
        return response()->json($data,200);
    }


    public function show($id)
    {
        //
    }

    public function exportView(){
        $data = jsonEncodePretty($this->getExportData());
        return view('admin.translations.export')->with(compact('data'));
    }

    public function export(){
        $data = $this->getExportData();
        foreach ($data as $lang => $value){
            $value = jsonEncodePretty($value);
            $path = public_path("langs/$lang.json");
            if(!file_exists($path)){
                touch($path);
            }
            file_put_contents($path,$value);
        }
        return redirect()->route('admin.translations.index')
            ->with(['success' => "Translations are exported to <code>/public/langs/{lang}.json</code> files successfully!"])
            ->withCookie(Cookie::forget('lang'));

    }


    public function getExportData(){
        $data = [];
        $translations = Translation::all();
        foreach ($translations as $translation){
            $translationValues = json_decode($translation->value,1);
            foreach ($translationValues as $translationKey => $translationValue){
                $data[$translationKey][$translation->group->name][$translation->key] = $translationValue;
            }
        }

        return $data;
    }

    public function edit(Translation $translation)
    {
        return view('admin.translations.edit')->with(compact('translation'));
    }


    public function update(Request $request, Translation $translation)
    {
        $request->validate([
            'group' => 'required|integer',
            'key' => 'required|string',
            'value' => 'required|array',
        ]);

        $oldData = $translation->key;
        $translation->group_id = $request->group;
        $translation->key = $request->key;
        $translation->value = json_encode($request->value,JSON_UNESCAPED_UNICODE);
        $translation->save();

        $data = [
            'status'    => 'success',
            'message'   => "Translation - <span class='font-weight-semibold'>{$oldData}</span> is updated successfully!"
        ];
        return response()->json($data,200);
    }


    public function destroy(Translation $translation)
    {
        $oldData = $translation->key;
        $translation->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Translation - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Translation::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>translations</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
