<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social_account extends Model
{
    public $timestamps = FALSE;
    public function Member(){
        return $this->belongsTo('App\Member');
    }
}
