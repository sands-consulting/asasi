<?php

use App\Notice;
use App\Permission;
use App\Subscription;
use App\Repositories\NoticesRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->truncate();

        $permissions = [
            ['notice:index', 'List all notices'],
            ['notice:show', 'View a notice'],
            ['notice:create', 'Create new notice'],
            ['notice:update', 'Update existing notice'],
            ['notice:duplicate', 'Duplicate existing notice'],
            ['notice:activate', 'Activate existing notice'],
            ['notice:deactivate', 'Deactivate existing notice'],
            ['notice:cancel', 'Cancel existing notice'],
            ['notice:publish', 'Publish existing notice'],
            ['notice:unpublish', 'Unpublish existing notice'],
            ['notice:delete', 'Delete existing notice'],
            ['notice:revisions', 'View notice revisions'],
            ['notice:logs', 'View notice logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

         // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(App\Permission::all()->lists('id')->toArray());

        $noticeData = [
            [
                'name' => 'Notice Tender',
                'number' => 'NT00001',
                'description' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'rules' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'price' =>  '250.00',
                'published_at' => '2016-08-01',
                'expired_at' => '2017-08-01',
                'purchased_at' => '2016-10-01',
                'submission_at' => '2016-12-01',
                'submission_address' => 'Address 1',
                'notice_type_id' => '1',
                'organization_id' => '1',
                'status' => 'draft'
            ],
            [
                'name' => 'Notice Quotation',
                'number' => 'NQ00001',
                'description' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'rules' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'price' =>  '150.00',
                'published_at' => '2016-08-01',
                'expired_at' => '2017-08-01',
                'purchased_at' => '2016-10-01',
                'submission_at' => '2016-12-01',
                'submission_address' => 'Address 2',
                'notice_type_id' => '2',
                'organization_id' => '1',
                'status' => 'draft'
            ],
        ];

        foreach ($noticeData as $notice) {
            NoticesRepository::create(new Notice(), $notice);
        }
    }
}
