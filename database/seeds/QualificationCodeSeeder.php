<?php

use App\Permission;
use App\Role;
use App\Repositories\PermissionsRepository;
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
        DB::table('qualification_code_types')->truncate();
        DB::table('qualification_codes')->truncate();

        $permissions = [
            'qualification-code' => [
                'index' => 'List all qualification codes',
                'show' => 'View qualification code details',
                'create' => 'Create new qualification code',
                'update' => 'Update existing qualification code',
                'delete' => 'Delete existing qualification code',
                'activate' => 'Activate qualification code',
                'deactivate' => 'Deactivate qualification code',
                'revisions' => 'View qualification code revisions',
                'logs' => 'View qualification code logs'
            ],
            'qualification-code-type' => [
                'index' => 'List all qualifiction code types',
                'show' => 'View qualification code type details',
                'create' => 'Create new qualification code type',
                'update' => 'Update existing qualification code type',
                'delete' => 'Delete existing qualification code type',
                'activate' => 'Activate qualification code type',
                'deactivate' => 'Deactivate qualification code type',
                'revisions' => 'View qualification code type revisions',
                'logs' => 'View qualification code type logs'
            ]
        ];

        foreach ($permissions as $group => $data) {
            foreach($data as $action => $description) {
                $perm = PermissionsRepository::create(new Permission(), [
                    'name'          => $group . ':' . $action,
                    'description'   => $description
                ]);
                $perm->roles()->attach(Role::first());
            }
        }
    }
}
