<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-sliders', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-sliders'  , ['only' => ['index']]);
        $this->middleware('permission:update-sliders', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-sliders', ['only' => ['destroy','destroySelecteds']]);

    }

    public function index()
    {
        $sliders = Slider::where('parent_id',null)->orderBy('id','desc')->get();
        return view('admin.sliders.index',compact('sliders'));

    }


    public function create()
    {
        return view('admin.sliders.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|nullable',
            'media' => 'required',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->target = $request->target;
        $slider->status = $request->status?true:false;
        $slider->author_id = user()->id;
        $slider->save();

        foreach($request->media as $order => $media_id){
            $subSlider = new Slider();
            $subSlider->parent_id = $slider->id;
            $subSlider->media_id = $media_id;
            $subSlider->title = $request->mediaTitles[$media_id]??'';
            $subSlider->target = null;
            $subSlider->author_id = user()->id;
            $subSlider->save();
        }


        $data = [
            'status'    => 'success',
            'message'   => "Slider <code>#{$slider->id}</code> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show()
    {
        //
    }


    public function edit(Slider $slider)
    {

        $subSliders = Slider::where('parent_id',$slider->id)->get();
        return view('admin.sliders.edit')->with(compact('slider','subSliders'));
    }


    public function update(Request $request,Slider $slider)
    {
        $request->validate([
            'title' => 'nullable',
            'media' => 'required',
        ]);


        $slider->title = $request->title;
        $slider->target = $request->target;
        $slider->status = $request->status?true:false;
        $slider->save();

        $subSliders = Slider::where('parent_id',$slider->id)->get();
        foreach ($subSliders as $subSlider){
            $subSlider->delete();
        }
        foreach($request->media as $order => $media_id){
            $subSlider = new Slider();
            $subSlider->parent_id = $slider->id;
            $subSlider->media_id = $media_id;
            $subSlider->title = $request->mediaTitles[$media_id]??'';
            $subSlider->target = null;
            $subSlider->author_id = user()->id;
            $subSlider->save();
        }


        $data = [
            'status'    => 'success',
            'message'   => "Slider <code>#{$slider->id}</code> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(Slider $slider)
    {
        $slider->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Post - <span class='font-weight-semibold'>#{$slider->id}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Slider::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>sliders</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
