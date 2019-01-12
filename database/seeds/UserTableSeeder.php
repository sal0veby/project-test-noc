<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $now = \Carbon\Carbon::now();

        DB::table('users')->updateOrInsert([
            'name' => $faker->name,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
            'active' => true,
            'default' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

    }
}
