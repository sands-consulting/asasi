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

        $gateway = PaymentGatewayService::create(new PaymentGateway, [
            'name' => 'Prompt Owner',
            'label' => 'BPZ',
            'type' => 'billplz'
        ]);
        $gateway->organizations()->attach(Organization::first());
        $gateway->settings()->create([
            'key' => 'api-key',
            'value' => 'asdf1234'
        ]);
        $gateway->settings()->create([
            'key' => 'collection-id',
            'value' => 'cid1234'
        ]);
    }
}
