<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $count = 50;

        for ($i = 0; $i < $count; $i++) {
            $product = new Product;
            $product->title = $faker->company;
            $product->price = $faker->randomNumber(6);
            $product->summary = $faker->paragraph(1, true);
            $product->thumbnail = $faker->imageUrl(640, 480);
            $product->quantity = mt_rand(10,100);
            $product->user_id = 1;
           // $category->role = 1;

            $product->save();
        }
    }
}
