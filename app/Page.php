<?php

namespace App;

use Botble\Media\Models\MediaFile;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function menu(){
        return $this->belongsTo('\App\Menu','menu_id','id');
    }

    public function author(){
        return $this->belongsTo('\App\User','author_id','id');
    }

    public static function getMedia($page_id){
        $page = Page::where('page_id',$page_id)->first();
        $medias = [];
        foreach (json_decode($page->media) as $media_id){
            $media = MediaFile::where('id',$media_id)->first();
            if($media) $medias[] = $media;
        }
        return $medias;
    }
}
