<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = FALSE;

    public function events_photo(){
        return $this->hasMany('App\Events_photo');
    }
}
