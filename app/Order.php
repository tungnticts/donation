<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public function package() {
        return $this->belongsTo('App\Package', 'package_id');
    }
}
