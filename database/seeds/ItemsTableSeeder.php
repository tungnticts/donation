<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $sizes = array(
            'XXS',
            'XS',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            'XXXL'
        );
        foreach ($products as $product) {
            foreach ($sizes as $size) {
                $p = new Item();
                $p->size = $size;
                $p->product_id = $product->id;
                $p->status = 0;
                $p->save();
            }
        }
    }
}
