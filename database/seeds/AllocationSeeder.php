<?php

use App\Permission;
use App\Role;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allocation_types')->truncate();
        DB::table('allocations')->truncate();

        $permissions = [
            'allocation' => [
                'index' => 'List all allocations',
                'show' => 'View allocation details',
                'create' => 'Create new allocation',
                'update' => 'Update existing allocation',
                'delete' => 'Delete existing allocation',
                'activate' => 'Activate allocation',
                'deactivate' => 'Deactivate allocation',
                'revisions' => 'View allocation revisions',
                'logs' => 'View allocation logs',
                'organization' => 'Allow to manage allocation with organization'
            ],
            'allocation-type' => [
                'index' => 'List all allocation types',
                'show' => 'View allocation type details',
                'create' => 'Create new allocation type',
                'update' => 'Update existing allocation type',
                'delete' => 'Delete existing allocation type',
                'activate' => 'Activate allocation type',
                'deactivate' => 'Deactivate allocation type',
                'revisions' => 'View allocation type revisions',
                'logs' => 'View allocation type logs'
            ]
        ];

        foreach ($permissions as $group => $data) {
            foreach($data as $action => $description) {
                $perm = PermissionsRepository::create(new Permission(), [
                    'name'          => $group . ':' . $action,
                    'description'   => $description
                ]);
                $perm->roles()->attach(Role::first());
            }
        }
    }
}
