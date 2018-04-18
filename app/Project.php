<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    public $timestamps = FALSE;

    public function Member(){
        return $this->belongsToMany('App\Member')
            ->withPivot('role');
    }
    public function Keyword(){
        return $this->belongsToMany('App\Keyword');
    }

    public function publication(){
        return $this->hasMany('App\Publication');
    }
    public function supporting_document(){
        return $this->hasMany('App\Supporting_document');
    }
}
