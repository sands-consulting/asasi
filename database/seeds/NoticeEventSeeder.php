<?php

use App\NoticeEvent;
use App\Permission;
use App\Subscription;
use App\Repositories\NoticeEventsRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class NoticeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_events')->truncate();

        $permissions = [
            ['notice-event:index', 'List all notice events'],
            ['notice-event:show', 'View a notice event'],
            ['notice-event:create', 'Create new notice event'],
            ['notice-event:update', 'Update existing notice event'],
            ['notice-event:duplicate', 'Duplicate existing notice event'],
            ['notice-event:activate', 'Activate existing notice event'],
            ['notice-event:deactivate', 'Deactivate existing notice event'],
            ['notice-event:delete', 'Delete existing notice event'],
            ['notice-event:revisions', 'View notice event revisions'],
            ['notice-event:logs', 'View notice event logs']
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
                'event_at' => Carbon\Carbon::now()->addMonth(),
                'location' => 'PEJABAT SETIAUSAHA KERAJAAN NEGERI SELANGOR,
                BANGUNAN SULTAN SALAHUDDIN ABDUL AZIZ SHAH,
                40503 SHAH ALAM,
                SELANGOR DARUL EHSAN.',
                'required' => true,
                'notice_id' => 1,
                'notice_event_type_id' => 1,
                'status' => 'active'
            ]
        ];

        foreach ($noticeEventTypeData as $noticeEventType) {
            NoticeEventsRepository::create(new NoticeEvent(), $noticeEventType);
        }
    }
}
