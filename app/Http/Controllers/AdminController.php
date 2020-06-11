<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Translation;
use Botble\Media\Http\Requests\MediaFileRequest;
use Botble\Media\Models\MediaFile;
use Botble\Media\Models\MediaFolder;
use Botble\Media\Repositories\Eloquent\MediaFileRepository;
use Botble\Media\Repositories\Eloquent\MediaFolderRepository;
use Botble\Media\RvMedia;
use Botble\Media\Services\ThumbnailService;
use Botble\Media\Services\UploadsManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $details = [];

        // Disk details
        $disk = $_SERVER['DOCUMENT_ROOT'];
        $disk_details = [];
        $disk_details['free'] = round(disk_free_space($disk)/1024/1024/1024,2)." GB";
        $disk_details['total'] = round(disk_total_space($disk)/1024/1024/1024,2)." GB";
        $disk_details['used'] = ((float)$disk_details['total'] - (float)$disk_details['free'])." GB";
        $disk_details['usage_percent'] = ((float)$disk_details['used']/(float)$disk_details['total'])*100;
        $details['disk'] = $disk_details;

//        dd($details);


        return view('admin.index',compact('details'));
    }



    public function mediaUpload(Request $request){
        $path = public_path().'/uploads/cropped-images/';
        if (!file_exists($path)) mkdir($path, 0777);
        $media_folder = MediaFolder::where('slug','cropped-images')->first();
        if(!$media_folder){
            $media_folder = new MediaFolder();
            $media_folder->user_id = auth()->user()->id;
            $media_folder->name = "Cropped images";
            $media_folder->slug = "cropped-images";
            $media_folder->parent_id = 0;
            $media_folder->save();
        }

        $base64_image = substr($request->image, strpos($request->image, ",")+1);
        $image = base64_decode($base64_image);
        $originalMedia = MediaFile::findOrFail($request->mediaId);
        $time = date('YmdHis');
        $image_name = "$originalMedia->name-cropped-{$time}.png";
        $realPath = $path.$image_name;
        file_put_contents($path.$image_name,$image);
        foreach (config('media.sizes') as $size) {
            $readable_size = explode('x', $size);
            (new ThumbnailService)
                ->setImage($realPath)
                ->setSize($readable_size[0], $readable_size[1])
                ->setDestinationPath('cropped-images')
                ->setFileName("$originalMedia->name-cropped-{$time}-$size.png")
                ->save();
        }


        $media = new MediaFile();
        $media->user_id = auth()->user()->id;
        $media->name = $image_name;
        $media->folder_id = $media_folder->id;
        $media->mime_type = "image/png";
        $media->size = filesize($path.$image_name);
        $media->url = "/uploads/cropped-images/$image_name";
        $media->options = [];
        $media->save();

        $data = [
            'status'    => 'success',
            'message'   => "File is edited successfully",
            'result'    => [
                'media' => $media
            ]
        ];
        return response()->json($data,200);
    }

    public function generateSlug(Request $request){
        return Str::slug($request->text);
    }

    public function generateOrderNumberInParent(Request $request){
        $orderData = ("App\\$request->model")::where($request->column,$request->value==='null'?null:$request->value)->orderBy('order','desc')->first();
        $newOrder = $orderData['order']+1;
        $data = [
            'status'    => 'success',
            'result'    => [
                'order' => $newOrder
            ]
        ];
        return response()->json($data,200);
    }

    public function reorder(Request $request){
        foreach ($request->reorders as $dataId => $order){
            $data = ("App\\$request->model")::findOrFail($dataId);
            $data->order = $order;
            $data->save();
        }
        $data = [
            'status'    => 'success',
            'message'   => translate('common.dataReorderedSuccessfully')
        ];
        return response()->json($data,200);
    }

}
