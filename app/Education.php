<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $timestamps = FALSE;
    protected $table = 'educations';
    public function Member(){
        return $this->belongsTo('App\Member');
    }
}
