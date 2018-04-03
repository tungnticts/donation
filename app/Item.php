<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //status: 0, 1: da ban, 2: da dat,
    protected $table = 'items';
    public function product() {
        return $this->belongsTo('App\Product');
    }
    public static function  total_item_by_status($status) {
        $total = Item::where('status', '=', $status)->count();
        return $total;
    }
}
