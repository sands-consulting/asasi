<?php

use App\Permission;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_names')->truncate();

        $permissions = [
            'allocation' => [
                'index' => 'List all model names',
                'show' => 'View model name details',
                'create' => 'Create new model name',
                'update' => 'Update existing model name',
                'delete' => 'Delete existing model name',
                'activate' => 'Activate model name',
                'deactivate' => 'Deactivate model name',
                'revisions' => 'View model name revisions',
                'logs' => 'View model name logs'
            ]
        ];

        foreach ($permissions as $group => $data) {
            foreach($data as $action => $description) {
                PermissionsRepository::create(new Permission(), [
                    'name'          => $group . ':' . $action,
                    'description'   => $description
                ]);
            }
        }
    }
}

