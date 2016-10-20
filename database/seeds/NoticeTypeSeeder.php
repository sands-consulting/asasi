<?php

use App\NoticeType;
use App\Permission;
use App\Subscription;
use App\Repositories\NoticeTypesRepository;
use App\Repositories\PermissionsRepository;
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

        $permissions = [
            ['notice-type:index', 'List all notice types'],
            ['notice-type:show', 'View a notice type'],
            ['notice-type:create', 'Create new notice type'],
            ['notice-type:update', 'Update existing notice type'],
            ['notice-type:duplicate', 'Duplicate existing notice type'],
            ['notice-type:activate', 'Activate existing notice type'],
            ['notice-type:deactivate', 'Deactivate existing notice type'],
            ['notice-type:delete', 'Delete existing notice type'],
            ['notice-type:revisions', 'View notice type revisions'],
            ['notice-type:logs', 'View notice type logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

         // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::whereNotIn('name', ['access:vendor'])->lists('id')->toArray());

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
            NoticeTypesRepository::create(new NoticeType(), $noticeType);
        }
    }
}
