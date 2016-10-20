<?php

use App\NoticeEventType;
use App\Permission;
use App\Subscription;
use App\Repositories\NoticeEventTypesRepository;
use App\Repositories\PermissionsRepository;
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

        $permissions = [
            ['notice-event-type:index', 'List all notice event types'],
            ['notice-event-type:show', 'View a notice event type'],
            ['notice-event-type:create', 'Create new notice event type'],
            ['notice-event-type:update', 'Update existing notice event type'],
            ['notice-event-type:duplicate', 'Duplicate existing notice event type'],
            ['notice-event-type:activate', 'Activate existing notice event type'],
            ['notice-event-type:deactivate', 'Deactivate existing notice event type'],
            ['notice-event-type:delete', 'Delete existing notice event type'],
            ['notice-event-type:revisions', 'View notice event type revisions'],
            ['notice-event-type:logs', 'View notice event type logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

         // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::whereNotIn('name', ['access:vendor'])->lists('id')->toArray());
        
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
            NoticeEventTypesRepository::create(new NoticeEventType(), $noticeEventType);
        }
    }
}
