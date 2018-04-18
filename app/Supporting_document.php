<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supporting_document extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function publication(){
        return $this->belongsTo('App\Publication');
    }
}
