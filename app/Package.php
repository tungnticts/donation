<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    public function project() {
        return $this->belongsTo('App\Project', 'project_id');
    }
    public function order() {
        return $this->hasMany('App\Order', 'package_id');
    }
}
