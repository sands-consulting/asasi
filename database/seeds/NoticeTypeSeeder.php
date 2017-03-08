<?php

use App\NoticeType;
use App\Permission;
use App\Subscription;
use App\Services\NoticeTypeService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class NoticeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_types')->truncate();

        $noticeTypeData = [
            [
                'name' => 'Tender',
                'status' => 'active'
            ],
            [
                'name' => 'Sebut Harga',
                'status' => 'active'
            ]
        ];

        foreach ($noticeTypeData as $noticeType) {
            NoticeTypeService::create(new NoticeType(), $noticeType);
        }
    }
}
