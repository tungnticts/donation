<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    public static function categories($product_id) {
        return DB::table('categories')
            ->join('products_in_categories', 'categories.id', '=', 'products_in_categories.category_id')
            ->select('categories.*')
            ->where('products_in_categories.product_id', '=', $product_id)
            ->get();
    }
    public static function packages($product_id) {
        return DB::table('packages')
            ->join('products_in_packages', 'packages.id', '=', 'products_in_packages.package_id')
            ->select('packages.*')
            ->where('products_in_packages.product_id', '=', $product_id)
            ->get();
    }
    public  function items() {
        return $this->hasMany('App\Item');
    }
}
