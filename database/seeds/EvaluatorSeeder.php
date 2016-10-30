<?php

use App\Permission;
use App\Role;
use App\User;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Repositories\PermissionsRepository;
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
        DB::table('notice_evaluators')->truncate();

        $permissions = [
            ['evaluator:index', 'List of evaluator\'s.']
        ];

        foreach ($permissions as $permissionData) {
            $perm = PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);

            // assign all permission to admin role
            $perm->roles()->attach(Role::first());
        }
    }
}
