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
                    'en' => 'Open the job document. Request to work.',
                    'th' => 'เปิดเอกสารงานขอเข้าทำงาน',
                ],
                'step' => 1,
            ],
            [
                'name' => [
                    'en' => 'Waiting to consider the approval of work.',
                    'th' => 'รอพิจารณาอนุมัติการขอเข้าทำงาน',
                ],
                'step' => 2.1,
            ],
            [
                'name' => [
                    'en' => 'Waiting for approval from the auditor.',
                    'th' => 'รอพิจารณาอนุมัติจากผู้ตรวจสอบ',
                ],
                'step' => 2.2,
            ],
            [
                'name' => [
                    'en' => 'Waiting for approval from the area administrator.',
                    'th' => 'รอพิจารณาอนุมัติจากผู้ดูแพื้นที่',
                ],
                'step' => 2.3,
            ],
            [
                'name' => [
                    'en' => 'Waiting for approval from the supervisor or project owner.',
                    'th' => 'รอการอนุมัติจากผู้คุมงาน / เจ้าของโครงการ',
                ],
                'step' => 3.1,
            ],
            [
                'name' => [
                    'en' => 'Security officers are checking.',
                    'th' => 'เจ้าหน้าที่รักษาความปลอดภัยกำลังตรวจสอบ',
                ],
                'step' => 3.2,
            ],
            [
                'name' => [
                    'en' => 'Checking operations.',
                    'th' => 'กำลังตรวจสอบการดำเนินงาน',
                ],
                'step' => 4,
            ],
            [
                'name' => [
                    'en' => 'Check the neatness from the supervisor or owner.',
                    'th' => 'ตรวจสอบความเรียบร้อยจากผู้คุมงาน / เจ้าของงาน',
                ],
                'step' => 5.1,
            ],
            [
                'name' => [
                    'en' => 'Security officers check before leaving the area.',
                    'th' => 'เจ้าหน้าที่รักษาความปลอดภัยตรวจสอบก่อนออกจากพื้นที่',
                ],
                'step' => 5.2,
            ],
            [
                'name' => [
                    'en' => 'Check completed.',
                    'th' => 'ทำการตรวจสอบเสร็จสิ้น',
                ],
                'step' => 6,
            ],
        ];


        foreach ($names as $val) {
            DB::table('step_jobs')->updateOrInsert([
                'step' => $val['step'],
            ], [
                'name'       => json_encode($val['name']),
                'step'       => $val['step'],
                'active'     => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

    }
}
