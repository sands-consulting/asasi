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

        $this->call(AllocationSeeder::class);
        $this->call(QualificationCodeSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(NoticeCategorySeeder::class);
        $this->call(NoticeTypeSeeder::class);
        $this->call(NoticeEventSeeder::class);
        $this->call(NoticeEventTypeSeeder::class);
        $this->call(SubmissionSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(ProjectSeeder::class);

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } catch (Exception $e) {
        }
    }
}
