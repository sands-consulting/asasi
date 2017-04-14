<?php

use App\NoticeEvent;
use App\Permission;
use App\Subscription;
use App\Services\NoticeEventService;
use App\Services\PermissionService;
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

        $noticeEventTypeData = [
            [
                'name' => 'Briefing',
                'schedule_at' => Carbon\Carbon::now()->addMonth(),
                'location' => 'PEJABAT SETIAUSAHA KERAJAAN NEGERI SELANGOR,
BANGUNAN SULTAN SALAHUDDIN ABDUL AZIZ SHAH,
40503 SHAH ALAM,
SELANGOR DARUL EHSAN.',
                'required' => true,
                'notice_id' => 1,
                'type_id' => 1,
                'status' => 'active'
            ]
        ];

        foreach ($noticeEventTypeData as $noticeEventType) {
            NoticeEventService::create(new NoticeEvent(), $noticeEventType);
        }
    }
}
