<?php

namespace App;

use Botble\Media\Models\MediaFile;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    protected $primaryKey = 'post_id';
    public function category(){
        return $this->belongsTo('\App\Category','category_id','id');
    }

    public function author(){
        return $this->belongsTo('\App\User','author_id','id');
    }

    public static function getMedia($post_id){
        $post = Post::where('post_id',$post_id)->first();
        $medias = [];
        foreach (json_decode($post->media) as $media_id){
            $media = MediaFile::where('id',$media_id)->first();
            if($media) $medias[] = $media;
        }
        return $medias;
    }

}
