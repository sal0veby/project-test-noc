<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class HotWorkTableSeeder extends Seeder
{
    public function run()
    {
        $names = [
            [
                'name' => 'เปิดเอกสารใบอนุญาตทำงานเสี่ยงอัคคีภัย',
                'step' => 1
            ],
            [
                'name' => 'ข้อพึงปฏิบัติและรายงานการตรวจสอบ',
                'step' => 2
            ],
            [
                'name' => 'ตรวจสอบอุปกรณ์ความปลอดภัยส่วนบุคคล (PPE)',
                'step' => 3
            ],
            [
                'name' => 'ยืนยันการตรวจสอบ',
                'step' => 4.1
            ],
            [
                'name' => 'เจ้าหน้าที่ยืนยันการตรวจสอบ',
                'step' => 4.2
            ],
            [
                'name' => 'ทำการตรวจสอบอุปกรณ์ (ก่อนทำ)',
                'step' => 4.3
            ],
            [
                'name' => 'ทำการตรวจสอบอุปกรณ์ (หลังทำ)',
                'step' => 4.4
            ]
        ];

        foreach ($names as $val) {
            DB::table('step_hot_works')->updateOrInsert([
                'name' => $val['name'],
                'step' => $val['step'],
            ], [
                'name' => $val['name'],
                'step' => $val['step'],
                'active' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
