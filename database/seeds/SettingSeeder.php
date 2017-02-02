<?php

use App\Setting;
use App\Permission;
use App\Subscription;
use App\Services\SettingService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        $permissions = [
            ['setting:index', 'List all settings'],
            ['setting:show', 'View a setting'],
            ['setting:create', 'Create new setting'],
            ['setting:update', 'Update existing setting'],
            ['setting:delete', 'Delete existing setting'],
            ['setting:revisions', 'View setting revisions'],
            ['setting:logs', 'View setting logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionService::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::whereNotIn('name', ['access:vendor'])->pluck('id')->toArray());

        $settings = [
            [
                'key' => 'currency',
                'value' => 'MYR'
            ],
            [
                'key' => 'date_format',
                'value' =>  'd/m/Y'
            ],
            [
                'key' => 'datetime_format',
                'value' => 'd/m/Y H:i'
            ],
            [
                'key' => 'vendor_role_id',
                'value' =>  '2'
            ]
        ];

        foreach ($settings as $setting) {
            SettingService::create(new Setting(), $setting);
        }
    }
}
