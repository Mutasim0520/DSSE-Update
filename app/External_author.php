<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class External_author extends Model
{
    public $timestamps = FALSE;
    public function Publication(){
        return $this->belongsToMany('App\Publication');
    }
}
