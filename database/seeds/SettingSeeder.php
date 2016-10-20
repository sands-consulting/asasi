<?php

use App\Setting;
use App\Permission;
use App\Subscription;
use App\Repositories\SettingsRepository;
use App\Repositories\PermissionsRepository;
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
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::whereNotIn('name', ['access:vendor'])->lists('id')->toArray());

        $settings = [
            [
                'key' => 'date_format',
                'value' =>  'd/m/Y',
                'item_type' =>  null,
                'item_id' => null,
            ],
            [
                'key' => 'vendor_role_id',
                'value' =>  '2',
                'item_type' =>  null,
                'item_id' => null,
            ]
        ];

        foreach ($settings as $setting) {
            SettingsRepository::create(new Setting(), $setting);
        }
    }
}
