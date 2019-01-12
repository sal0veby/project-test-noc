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
        $stepJobs = DB::table('step_jobs')->where('active', true)->get();

        $states = [
            [
                'state' => 1,
                'description' => 'save'
            ],
            [
                'state' => 2,
                'description' => 'approve'
            ]
        ];
        if (!empty($stepJobs)) {
            foreach ($stepJobs as $val) {
                foreach ($states as $item) {
                    $exists = DB::table('process_jobs')
                        ->where([
                            'step_job_id' => $val->id,
                            'state_job' => $item['state']
                        ])
                        ->exists();

                    if (!$exists) {
                        DB::table('process_jobs')->insert([
                            'step_job_id' => $val->id,
                            'state_job' => $item['state'],
                            'description' => $item['description'],
                            'active' => true,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now()
                        ]);
                    }
                }
            }
        }
    }
}
