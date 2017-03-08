<?php

use App\Permission;
use App\Role;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class QualificationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualification_types')->truncate();
        DB::table('qualification_codes')->truncate();
    }
}
