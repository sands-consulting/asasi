<?php

use App\Permission;
use App\Subscription;
use App\Services\SubscriptionService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->truncate();

        SubscriptionService::create(new Subscription, [
            'started_at' => '2016-08-01',
            'expired_at' => '2017-08-01',
            'vendor_id' => 1,
            'package_id' => 1,
            'status' => 'active'
        ]);
    }
}
