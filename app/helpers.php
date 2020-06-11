<?php

use App\Language;
use App\Translation;
use App\TranslationGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

function checkRouteMenuActive($route){
    $currentRoute = Route::currentRouteName();
    return $currentRoute===$route?'active':'';
}

function checkRouteGroupActive($routeGroup=null,$groupOpened=' nav-item-open'){
    $currentRoute = Route::currentRouteName();
    return in_array($currentRoute,$routeGroup)?'nav-item-expanded'.$groupOpened:'';
}


function user(){
    $user = json_decode(json_encode(auth()->user()));
    $user->info = json_decode($user->info);
    return $user;
}

function getArrayFromChildValue($array,$childKey){
    $array = json_decode(json_encode($array),1);
    $newArray = [];
    foreach ($array as $value){
        $newArray[] = $value[$childKey];
    }
    return $newArray;
}

function getStatus($status){
    return $status?'<div class="badge badge-success">Active</div>':'<div class="badge badge-danger">Disabled</div>';
}

function getLastOrder($table){
    $last = DB::table($table)->latest('order')->first();
    return $last?$last->order+1:1;
}

function alert($message,$type='success'){
    return "
        <div class='alert alert-$type border-0 mb-0 alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'><span>×</span></button>
            {$message}
        </div>
    ";
}

function yandexUrl(){
    return "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20200303T001304Z.3dc28d2592141203.b5bf9d6f88614ae0e3e867f4fb02957d6797b7ca&format=plain";
}



function getLocale(){
    $language = session('language')??'az';
    return $language;
}

function getLocales(){
    $languages = Language::where('status',true)->get();
    $collect = collect($languages)->map(function($language){
        return $language->key;
    });
    return $collect;
}

function getLanguage(){
    $language = Language::where('key',getLocale())->first();
    return $language;
}

function getLanguages(){
    $languages = Language::where('status',true)->get();
    return $languages;
}

function getLangJson(){
    $locale = getLocale();
    $langFile = public_path("langs/$locale.json");
    $translationData = [];
    if(file_exists($langFile)) $translationData = json_decode(file_get_contents($langFile),1);
    return $translationData;
}

function translate($text){
    $data = explode('.',$text);
    $groupName = $data[0];
    $translationKey = $data[1];
    $translationData = getLangJson();
    @$group = $translationData[$groupName];
    @$translation = $group[$translationKey];
    return $translation??$text;
}

function translateWithAttribute($text,$attributes=null){
    $data = explode('.',$text);
    $groupName = $data[0];
    $translationKey = $data[1];
    $translationData = getLangJson();
    @$group = $translationData[$groupName];
    @$translation = $group[$translationKey];
    if($attributes){
        foreach ($attributes as $attribute => $value){
            $translation = preg_replace("/#{$attribute}/im","$value",$translation);
        }
    }
    return $translation??$text;
}

function jsonEncodePretty($value){
    return json_encode($value,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
}

function getCounts($table){
    $count = DB::table($table)->count();
    return $count;
}

function colorPart() {
    return str_pad( dechex( mt_rand( 0, 255*1000 )/1000 ), 2, '0', STR_PAD_LEFT);
}

function generateHEXColor() {
    return colorPart() . colorPart() . colorPart();
}

function generateColor($existColors = []){
    $colors = ['slate','violet','purple','indigo','blue','teal','green','orange','brown','grey','info','primary','danger','success','warning'];
    foreach ($existColors as $existColor){
        $key = array_search($existColor,$colors);
        if($key) unset($colors[$key]);
    }
    return $colors[array_rand($colors)];
}

function humanDate($date){
    return Carbon::createFromFormat('Y-m-d H:i:s',$date)->format('d.m.Y H:i:s');
}

function dbDate($date){
    return Carbon::createFromFormat('d.m.Y H:i:s',$date)->format('Y-m-d H:i:s');
}

function getYoutubeIdFromUrl($url) {
    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
    $match = preg_match($regExp,$url);
    $id = preg_replace($regExp,'$2',$url);
    return ($match && strlen($id) === 11) ? $id : null;
}
function generateYoutubeEmbedUrl($url){
    return "https://www.youtube.com/embed/".getYoutubeIdFromUrl($url)."?enablejsapi=1";
}

