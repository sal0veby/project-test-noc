<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class StepJobsTableSeeder extends Seeder
{
    public function run()
    {
        $names = [
            [
                'name' => [
                    'en' => 'AAA',
                    'th' => 'เปิดเอกสารงาน'
                ],
                'step' => 1
            ],
            [
                'name' => [
                    'en' => 'BBB',
                    'th' => 'พิจารณาอนุมัติการขอเข้าทำงาน'
                ],
                'step' => 2.1
            ],
            [
                'name' => [
                    'en' => 'CCC',
                    'th' => 'พิจารณาอนุมัติการขอเข้าทำงาน'
                ],
                'step' => 2.2
            ],
            [
                'name' => [
                    'en' => 'DDD',
                    'th' => 'พิจารณาอนุมัติการขอเข้าทำงาน'
                ],
                'step' => 2.3
            ],
            [
                'name' => [
                    'en' => 'EEE',
                    'th' => 'ก่อนเริ่มดำเนินงาน'
                ],
                'step' => 3.1
            ],
            [
                'name' => [
                    'en' => 'FFF',
                    'th' => 'ก่อนเริ่มดำเนินงาน'
                ],
                'step' => 3.2
            ],
            [
                'name' => [
                    'en' => 'GGG',
                    'th' => 'ตรวจสอบการดำเนินงาน'
                ],
                'step' => 4
            ],
            [
                'name' => [
                    'en' => 'HHH',
                    'th' => 'ดำเนินงานเสร็จสิ้น'
                ],
                'step' => 5.1
            ],
            [
                'name' => [
                    'en' => 'III',
                    'th' => 'ดำเนินงานเสร็จสิ้น'
                ],
                'step' => 5.2
            ],
        ];


        foreach ($names as $val) {
            DB::table('step_jobs')->updateOrInsert([
                'step' => $val['step'],
            ], [
                'name' => json_encode($val['name']),
                'step' => $val['step'],
                'active' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

    }
}
