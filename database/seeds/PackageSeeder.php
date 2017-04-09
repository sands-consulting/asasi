<?php

use App\Package;
use App\Permission;
use App\Subscription;
use App\TaxCode;
use App\Services\PackageService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->truncate();

        $packageData = [
            [
                'name' => 'Package 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'month',
                'validity_quantity' => '6',
                'fee_amount' =>  '50.00',
                'tax_code_id' => TaxCode::first()->id,
                'status' => 'active'
            ],
            [
                'name' => 'Package 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'year',
                'validity_quantity' => '1',
                'fee_amount' =>  '150.00',
                'tax_code_id' => TaxCode::first()->id,
                'status' => 'active'
            ],
            [
                'name' => 'Package 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'year',
                'validity_quantity' => '2',
                'fee_amount' =>  '250.00',
                'tax_code_id' => TaxCode::first()->id,
                'status' => 'active'
            ]
        ];

        foreach ($packageData as $package) {
            PackageService::create(new Package(), $package);
        }
    }
}
