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

        $permissions = [
            ['notice-category:index', 'List all notice categories'],
            ['notice-category:show', 'View a notice category'],
            ['notice-category:create', 'Create new notice category'],
            ['notice-category:update', 'Update existing notice category'],
            ['notice-category:duplicate', 'Duplicate existing notice category'],
            ['notice-category:activate', 'Activate existing notice category'],
            ['notice-category:deactivate', 'Deactivate existing notice category'],
            ['notice-category:delete', 'Delete existing notice category'],
            ['notice-category:revisions', 'View notice category revisions'],
            ['notice-category:logs', 'View notice category logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionService::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

         // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::whereNotIn('name', ['access:vendor'])->pluck('id')->toArray());
        
        $noticeEventTypeData = [
            [
                'name' => 'Tender',
                'status' => 'active'
            ],
            [
                'name' => 'Sebut Harga',
                'status' => 'active'
            ]
        ];

        foreach ($noticeEventTypeData as $noticeEventType) {
            NoticeCategoryService::create(new NoticeCategory(), $noticeEventType);
        }
    }
}
