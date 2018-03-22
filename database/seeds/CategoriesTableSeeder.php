<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;

        for ($i = 0; $i < $count; $i++) {
            $category = new Category;
            $category->title = 'category_'.$i;
            $category->summary = 'summary_'.$i;
            $category->thumbnail = 'http://homestead.test/images/default.jpg';
           // $category->role = 1;

            $category->save();
        }
    }
}
