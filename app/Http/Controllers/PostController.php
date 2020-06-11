<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create-posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-posts'  , ['only' => ['index']]);
        $this->middleware('permission:update-posts', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-posts', ['only' => ['destroy','destroySelecteds']]);

    }

    public function index()
    {
        $posts = Post::where('locale',getLocale())->orderBy('date','desc')->get();
        return view('admin.posts.index',compact('posts'));

    }


    public function create()
    {
        $categories = Category::getCategories();
        return view('admin.posts.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array|check_array:1',
            'title.*' => 'string|nullable',
            'content' => 'required|array|check_array:1',
            'content.*' => 'string|nullable',
            'slug' => 'required|array|check_array:1|unique:posts',
            'slug.*' => 'string|nullable',
            'category' => 'required|integer',
            'date' => 'required|date_format:d.m.Y H:i:s',
        ]);


        $post_id = uniqid();
        foreach (getLocales() as $locale){
            $post = new Post();
            $post->post_id = $post_id;
            $post->locale = $locale;
            $post->category_id = $request->category;
            $post->author_id = user()->id;
            $post->title = $request->title[$locale];
            $post->slug = $request->slug[$locale];
            $post->content = $request->{'content'}[$locale];
            $post->media = $request->media;
            $post->date = dbDate($request->date);
            $post->save();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Post <code>{$request->title[getLocale()]}</code> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show(Post $post)
    {
        //
    }


    public function edit($post_id)
    {
        $categories = Category::getCategories();
        $post_data = Post::where('post_id',$post_id)->get();
        $posts = [];
        foreach ($post_data as $data){
           $posts[$data->locale] = $data;
        }
        return view('admin.posts.edit')->with(compact('posts','categories'));
    }


    public function update(Request $request, $post_id)
    {
        $posts = Post::where('post_id',$post_id)->get();
        $slug_validaiton = '';
        foreach ($posts as $post) {
            $slug_validaiton .= '|unique:posts,slug,'.$post->id;
        }
        $request->validate([
            'title' => 'required|array|check_array:1',
            'title.*' => 'string|nullable',
            'content' => 'required|array|check_array:1',
            'content.*' => 'string|nullable',
            'slug' => 'required|array|check_array:1'.$slug_validaiton,
            'slug.*' => 'string|nullable',
            'category' => 'required|integer',
            'date' => 'required|date_format:d.m.Y H:i:s',
        ]);


        foreach (getLocales() as $locale){
            $post = Post::where('post_id',$post_id)->where('locale',$locale)->first();
            if(!$post){ // eger bu dilde post yoxdursa yenisini yaradir
                $post = new Post();
                $post->post_id = $post_id;
                $post->locale = $locale;
                $post->author_id = user()->id;
            }
            $post->category_id = $request->category;
            $post->title = $request->title[$locale];
            $post->slug = $request->slug[$locale];
            $post->content = $request->{'content'}[$locale];
            $post->media = $request->media;
            $post->date = dbDate($request->date);
            $post->save();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Post <code>{$request->title[getLocale()]}</code> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(Post $post)
    {
        $oldData = $post->title;
        $post->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Post - <span class='font-weight-semibold'>{$oldData}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Post::where('post_id',$selected)->first();
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>posts</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }

}
