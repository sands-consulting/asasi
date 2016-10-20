<?php

use App\Permission;
use App\Evaluation;
use App\Repositories\SubscriptionsRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
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
            ['evaluation:index', 'List of evaluator\'s notices.'],
            ['evaluation:evaluate', 'Evaluate submisssion.'],
            ['evaluation:settings', 'Evaluation Settings.']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        // Assign admin role to all permission.
        App\Role::first()->permissions()->sync(Permission::whereNotIn('name', ['access:vendor'])->lists('id')->toArray());
        App\Role::find(3)->permissions()->attach(Permission::whereGroup('evaluation')->lists('id')->toArray());
    }
}
