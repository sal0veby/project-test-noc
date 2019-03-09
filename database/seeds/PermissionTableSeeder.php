<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\DB;
use Laracasts\TestDummy\Factory as TestDummy;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $names = ['Menu Manage' , 'Menu Report' , 'Menu Manage User'];

        foreach ($names as $name) {
            $exists = DB::table('permissions')->where('name', $name)->exists();
            if (! $exists) {
                DB::table('permissions')->insert([
                    'name' => $name,
                    'guard_name' => 'web',
                    'active' => true,
                    'default' => true,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
