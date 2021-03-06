<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        } catch (Exception $e) {
        }

        $this->call(SettingSeeder::class);
        $this->call(AclSeeder::class);
        $this->call(AsasiSeeder::class);

        $this->call(NewsSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
        $this->call(PlaceSeeder::class);

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } catch (Exception $e) {
        }
    }
}
