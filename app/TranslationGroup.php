<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationGroup extends Model
{
    public function translations(){
        return $this->hasMany('\App\Translation','group_id','id');
    }
}
