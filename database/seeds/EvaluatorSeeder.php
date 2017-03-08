<?php

use App\Permission;
use App\Role;
use App\User;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class EvaluatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_evaluator')->truncate();
    }
}
