<?php

use App\Subscription;
use App\Transaction;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
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

        $subscription = SubscriptionService::create(new Subscription, [
            'started_at' => '2016-08-01',
            'expired_at' => '2017-08-01',
            'package_id' => 1,
            'subscriber_id' => 1,
            'subscriber_type' => 'App\Vendor',
            'user_id' => Vendor::first()->users()->first()->id,
            'status' => 'active'
        ]);

        $transaction = TransactionService::create(new Transaction, [
            
        ]);
    }
}
