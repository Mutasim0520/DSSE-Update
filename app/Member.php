<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'member_id';
    public $timestamps = FALSE;

    public function Project(){
        return $this->belongsToMany('App\Project')
            ->withPivot('role');
    }

    public function Publication(){
        return $this->belongsToMany('App\Publication');
    }

    public function Education(){
        return $this->hasMany('App\Education');
    }

    public function Experience(){
        return $this->hasMany('App\Experience');
    }

    public function documents(){
        return $this->hasMany('App\Supporting_document');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function social_account(){
        return $this->hasMany('App\Social_account');
    }
}
