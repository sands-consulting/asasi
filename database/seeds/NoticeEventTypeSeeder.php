<?php

use App\NoticeEventType;
use App\Permission;
use App\Subscription;
use App\Services\NoticeEventTypeService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class NoticeEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_event_types')->truncate();

        $noticeEventTypeData = [
            [
                'name' => 'Briefing',
                'status' => 'active'
            ],
            [
                'name' => 'Site Visit',
                'status' => 'active'
            ]
        ];
        foreach ($noticeEventTypeData as $noticeEventType) {
            NoticeEventTypeService::create(new NoticeEventType(), $noticeEventType);
        }
    }
}
