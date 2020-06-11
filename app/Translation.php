<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public function group(){
        return $this->belongsTo('\App\TranslationGroup','group_id','id');
    }
}
