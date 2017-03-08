<?php

use App\Organization;
use App\PaymentGateway;
use App\Permission;
use App\Role;
use App\Services\PaymentGatewayService;
use App\Services\PermissionService;
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

        $gateway = PaymentGatewayService::create(new PaymentGateway, ['name' => 'Default eBPG', 'label' => 'eBPG', 'type' => 'Ebpg']);
        $gateway->organizations()->attach(Organization::first());
    }
}
