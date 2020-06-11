<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function media(){
        return $this->belongsTo('\Botble\Media\Models\MediaFile','media_id','id');
    }

    public function author(){
        return $this->belongsTo('\App\User','author_id','id');
    }
}
