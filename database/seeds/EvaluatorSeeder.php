<?php

use App\Permission;
use App\Evaluation;
use App\Repositories\SubscriptionsRepository;
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
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(Permission::all()->lists('id')->toArray());
    }
}
