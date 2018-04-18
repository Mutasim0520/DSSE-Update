<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Publication extends Model
{
    protected $primaryKey = 'publication_id';
    public $timestamps = FALSE;

    public function Member(){
        return $this->belongsToMany('App\Member');
    }

    public function External_author(){
        return $this->belongsToMany('App\External_author');
    }

    public function Keyword(){
        return $this->belongsToMany('App\Keyword');
    }
    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function supporting_document(){
        return $this->hasMany('App\Supporting_document');
    }



}
