<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-banners', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-banners'  , ['only' => ['index']]);
        $this->middleware('permission:update-banners', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-banners', ['only' => ['destroy','destroySelecteds']]);

    }

    public function index()
    {
        $banners = Banner::orderBy('id')->get();
        return view('admin.banners.index',compact('banners'));
    }


    public function create()
    {
        return view('admin.banners.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|nullable',
            'text' => 'string|nullable',
            'url' => 'string|nullable',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->text = $request->text;
        $banner->url = $request->url;
        $banner->target = $request->target;
        $banner->style = $request->style;
        $banner->media_id = $request->media[0];
        $banner->author_id = user()->id;
        $banner->order = $request->order;
        $banner->status = $request->status?true:false;
        $banner->save();



        $data = [
            'status'    => 'success',
            'message'   => "Banner <code>#{$banner->id}</code> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show()
    {
        //
    }


    public function edit(Banner $banner)
    {

        return view('admin.banners.edit')->with(compact('banner'));
    }


    public function update(Request $request,Banner $banner)
    {
        $request->validate([
            'title' => 'string|nullable',
            'text' => 'string|nullable',
            'url' => 'string|nullable',
        ]);

        $banner->title = $request->title;
        $banner->text = $request->text;
        $banner->url = $request->url;
        $banner->target = $request->target;
        $banner->style = $request->style;
        $banner->media_id = $request->media[0];
        $banner->order = $request->order;
        $banner->status = $request->status?true:false;
        $banner->save();

        $data = [
            'status'    => 'success',
            'message'   => "Banner <code>#{$banner->id}</code> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Post - <span class='font-weight-semibold'>#{$banner->id}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Banner::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>banners</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
