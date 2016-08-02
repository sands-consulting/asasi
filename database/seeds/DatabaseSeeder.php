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
        Model::unguard();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        } catch (Exception $e) {
        }

        $this->call(AsasiSeeder::class);
        $this->call(AllocationSeeder::class);
        $this->call(QualificationCodeSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(VendorSeeder::class);

        Model::reguard();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } catch (Exception $e) {
        }
    }
}
