<?php

use Illuminate\Database\Seeder;
use App\Package;
use App\Project;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $count = 5;

        $projects = Project::all();

        foreach ($projects as $key => $project) {
            for ($i = 0; $i < $count; $i++) {
                $package = new Package;
                $package->project_id = $project->id;
                $package->title = $faker->sentence(6, false);
                $package->thumbnail = $faker->imageUrl($width = 640, $height = 480);
                $package->content = $faker->paragraph(2);
                $package->user_id = 1;
                $package->save();
            }
        }

    }
}
