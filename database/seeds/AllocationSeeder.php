<?php

use App\Allocation;
use App\AllocationType;
use App\Permission;
use App\Role;
use App\Services\AllocationService;
use App\Services\AllocationTypeService;
use App\Services\PermissionService;
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
        DB::table('allocation_project')->truncate();
        DB::table('allocation_notice')->truncate();
        DB::table('allocation_types')->truncate();
        DB::table('allocations')->truncate();

        $allocationTypeData = [
            [
                'name' => 'Developments',
                'status' =>  'active'
            ],
            [
                'name' => 'Operations',
                'status' =>  'active'
            ],
            [
                'name' => 'Corporate Communications',
                'status' =>  'active'
            ],
        ];

        foreach ($allocationTypeData as $allocationType) {
            AllocationTypeService::create(new AllocationType(), $allocationType);
        }

        $allocationData = [
            [
                'name' => 'Information Communication Technology',
                'value' => '500000',
                'type_id' =>  1,
                'organization_id' => 1,
                'status' =>  'active'
            ],
            [
                'name' => 'Human Resources',
                'value' => '700000',
                'type_id' =>  2,
                'organization_id' => 1,
                'status' =>  'active'
            ],
            [
                'name' => 'Sales & Marketing',
                'value' => '1000000',
                'type_id' =>  3,
                'organization_id' => 1,
                'status' =>  'active'
            ],
        ];

        foreach ($allocationData as $allocation) {
            $allocation = AllocationService::create(new Allocation(), $allocation);
            $allocation->notices()->attach(1, ['amount' => '100000']);
        }
    }
}
