<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events_photo extends Model
{
    public $timestamps = FALSE;
    public function event(){
        return $this->belongsTo('App\Event');
    }
}
