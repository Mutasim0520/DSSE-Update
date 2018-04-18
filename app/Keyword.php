<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public $timestamps = FALSE;

    public function Publication(){
        return $this->belongsToMany('App\Publication');
    }
    public function Project(){
        return $this->belongsToMany('App\Project');
    }

}
