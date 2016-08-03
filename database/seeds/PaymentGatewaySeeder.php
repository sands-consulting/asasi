<?php

use App\Organization;
use App\PaymentGateway;
use App\Permission;
use App\Role;
use App\Repositories\PaymentGatewaysRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_payment_gateway')->truncate();
        DB::table('payment_gateways')->truncate();

        $permissions = [
            'payment-gateways' => [
                'index' => 'List all payment gateways',
                'show' => 'View payment gateway details',
                'create' => 'Create new payment gateway',
                'update' => 'Update existing payment gateway',
                'delete' => 'Delete existing payment gateway',
                'activate' => 'Activate payment gateway',
                'deactivate' => 'Deactivate payment gateway',
                'revisions' => 'View payment gateway revisions',
                'logs' => 'View payment gateway logs'
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

        $gateway = PaymentGatewaysRepository::create(new PaymentGateway, ['name' => 'Default eBPG', 'label' => 'eBPG', 'type' => 'Ebpg']);
        $gateway->organizations()->attach(Organization::first());
    }
}
