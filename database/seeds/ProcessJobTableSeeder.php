<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessJobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $step_name = [
            [
                'process_id'       => 1,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 1,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 1,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 2,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 2,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 2,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 2,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 3,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 3,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 3,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 3,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 4,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 4,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 4,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 4,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 5,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 5,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 5,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 5,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 6,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 6,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 6,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 6,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 7,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 7,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 7,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 7,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 8,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 8,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 8,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 8,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 9,
                'next_state_id'    => 1,
                'next_description' => 'save',
            ],
            [
                'process_id'       => 9,
                'state_id'         => 1,
                'description'      => 'save',
                'next_process_id'  => 9,
                'next_state_id'    => 2,
                'next_description' => 'approve',
            ],
            [
                'process_id'       => 9,
                'state_id'         => 2,
                'description'      => 'approve',
                'next_process_id'  => 10,
                'next_state_id'    => 1,
                'next_description' => 'success',
            ],
        ];

        foreach ($step_name as $index => $val) {
            $exists = DB::table('process_jobs')
                ->where([
                    'process_id' => array_get($val, 'process_id'),
                    'state_id'   => array_get($val, 'state_id'),
                ])
                ->exists();

            if (!$exists) {
                DB::table('process_jobs')->insert([
                    'process_id' => array_get($val, 'process_id'),
                    'state_id'   => array_get($val, 'state_id'),
                    'description' => array_get($val, 'description'),
                    'next_process_id' => array_get($val, 'next_process_id'),
                    'next_state_id'   => array_get($val, 'next_state_id'),
                    'next_description' => array_get($val, 'next_description'),
                    'active'      => true,
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ]);
            }
        }
    }
}
