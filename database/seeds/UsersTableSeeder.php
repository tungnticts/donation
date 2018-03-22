<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $count = 3;

        for ($i = 0; $i < $count; $i++) {
            $user = new User;
            $user->user_name = 'admin'.$i;
            $user->password = bcrypt('123457');
            $user->email = str_random(10).'@gmail.com';
            $user->role = 1;

            $user->save();
        }
    }
}
