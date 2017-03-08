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
