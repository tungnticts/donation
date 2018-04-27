<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function package() {
        //print_r($this->hasMany('App\Package', 'project_id'));

        return $this->hasMany('App\Package', 'project_id');
    }
}
