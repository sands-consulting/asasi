<?php

use App\NoticeCategory;
use App\Permission;
use App\Subscription;
use App\Services\NoticeCategoryService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class NoticeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_categories')->truncate();
        
        $noticeEventTypeData = [
            [
                'name' => 'Information Technology',
                'status' => 'active'
            ],
            [
                'name' => 'Public Infrastructure',
                'status' => 'active'
            ]
        ];

        foreach ($noticeEventTypeData as $noticeEventType) {
            NoticeCategoryService::create(new NoticeCategory(), $noticeEventType);
        }
    }
}
