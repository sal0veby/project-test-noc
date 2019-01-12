<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(StepJobsTableSeeder::class);
        $this->call(StepJobsTableSeeder::class);
        $this->call(HotWorkTableSeeder::class);
        $this->call(ProcessJobTableSeeder::class);
    }
}
