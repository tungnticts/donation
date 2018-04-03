<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Package;
use App\ProductInPackage;

class ProductsInPackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        
        $array_products = array();
        foreach ($products as $product) {
            array_push($array_products, $product->id);
        }

        $packages = Package::all();
        foreach ($packages as $package) {
            for ($i = 0; $i < 5; $i++) {
                $index = array_rand($array_products);
                $check = ProductInPackage::where([
                    ['product_id', '=', $array_products[$index]],
                    ['package_id', '=', $package->id],
                ])->first();
                if (!$check) {
                    $push = new ProductInPackage;
                    $push->product_id = $array_products[$index];
                    $push->package_id = $package->id;
                    $push->save();
                }
            }
        }
    }
}
