<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\Menu;
use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create-pages', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-pages'  , ['only' => ['index']]);
        $this->middleware('permission:update-pages', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-pages', ['only' => ['destroy','destroySelecteds']]);

    }

    public function index()
    {
        $pages = Page::where('locale',getLocale())->orderBy('date','desc')->get();
        return view('admin.pages.index',compact('pages'));

    }


    public function create()
    {
        $menus = Menu::getMenus();
        return view('admin.pages.create',compact('menus'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array|check_array:1',
            'title.*' => 'string|nullable',
            'content' => 'required|array|check_array:1',
            'content.*' => 'string|nullable',
            'slug' => 'required|array|check_array:1|unique:pages',
            'slug.*' => 'string|nullable',
            'menu' => 'required|integer',
            'date' => 'required|date_format:d.m.Y H:i:s',
        ]);


        $page_id = uniqid();
        foreach (getLocales() as $locale){
            $page = new Page();
            $page->page_id = $page_id;
            $page->locale = $locale;
            $page->menu_id = $request->menu;
            $page->author_id = user()->id;
            $page->title = $request->title[$locale];
            $page->slug = $request->slug[$locale];
            $page->content = $request->{'content'}[$locale];
            $page->media = json_encode($request->media);
            $page->date = dbDate($request->date);
            $page->save();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Page <code>{$request->title[getLocale()]}</code> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show(Page $page)
    {
        //
    }


    public function edit($page_id)
    {
        $menus = Menu::getMenus();
        $page_data = Page::where('page_id',$page_id)->get();
        $pages = [];
        foreach ($page_data as $data){
            $pages[$data->locale] = $data;
        }
        return view('admin.pages.edit')->with(compact('pages','menus'));
    }


    public function update(Request $request, $page_id)
    {
        $pages = Page::where('page_id',$page_id)->get();
        $slug_validaiton = '';
        foreach ($pages as $page) {
            $slug_validaiton .= '|unique:pages,slug,'.$page->id;
        }
        $request->validate([
            'title' => 'required|array|check_array:1',
            'title.*' => 'string|nullable',
            'content' => 'required|array|check_array:1',
            'content.*' => 'string|nullable',
            'slug' => 'required|array|check_array:1'.$slug_validaiton,
            'slug.*' => 'string|nullable',
            'menu' => 'required|integer',
            'date' => 'required|date_format:d.m.Y H:i:s',
        ]);


        foreach (getLocales() as $locale){
            $page = Page::where('page_id',$page_id)->where('locale',$locale)->first();
            if(!$page){ // eger bu dilde page yoxdursa yenisini yaradir
                $page = new Page();
                $page->page_id = $page_id;
                $page->locale = $locale;
                $page->author_id = user()->id;
            }
            $page->menu_id = $request->menu;
            $page->title = $request->title[$locale];
            $page->slug = $request->slug[$locale];
            $page->content = $request->{'content'}[$locale];
            $page->media = $request->media;
            $page->date = dbDate($request->date);
            $page->save();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Page <code>{$request->title[getLocale()]}</code> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(Page $page)
    {
        $oldData = $page->title;
        $page->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Page - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Page::where('page_id',$selected)->first();
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>pages</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }

}
