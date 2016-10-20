<?php

use App\Permission;
use App\Subscription;
use App\Repositories\SubscriptionsRepository;
use App\Repositories\PermissionsRepository;
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

        $permissions = [
            ['subscription:index', 'List all subscriptions'],
            ['subscription:show', 'View a subscription'],
            ['subscription:create', 'Create new subscription'],
            ['subscription:update', 'Update existing subscription'],
            ['subscription:duplicate', 'Duplicate existing subscription'],
            ['subscription:activate', 'Activate existing subscription'],
            ['subscription:deactivate', 'Deactivate existing subscription'],
            ['subscription:cancel', 'Cancel existing subscription'],
            ['subscription:delete', 'Delete existing subscription'],
            ['subscription:revisions', 'View subscription revisions'],
            ['subscription:logs', 'View subscription logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(Permission::whereNotIn('name', ['access:vendor'])->lists('id')->toArray());

        SubscriptionsRepository::create(new Subscription, [
            'started_at' => '2016-08-01',
            'expired_at' => '2017-08-01',
            'vendor_id' => 1,
            'package_id' => 1,
            'status' => 'active'
        ]);
    }
}
